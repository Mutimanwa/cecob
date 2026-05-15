<?php

declare(strict_types=1);

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function is_logged_in(): bool
{
    return isset($_SESSION['user']['id']);
}

function require_admin(): void
{
    if (! is_logged_in()) {
        set_flash('danger', 'Veuillez vous connecter.');
        redirect_to('admin/sign-in.php');
    }
}

function attempt_login(string $email, string $password): bool
{
    if (! db()) {
        return false;
    }

    $stmt = db()->prepare('SELECT u.id, u.full_name, u.email, u.password_hash, r.name AS role_name FROM users u LEFT JOIN roles r ON r.id = u.role_id WHERE u.email = ? AND u.account_status = ? LIMIT 1');
    $stmt->execute([$email, 'active']);
    $user = fetch_one_assoc($stmt);

    if (! $user || ! password_verify($password, $user['password_hash'])) {
        return false;
    }

    $_SESSION['user'] = [
        'id' => $user['id'],
        'full_name' => $user['full_name'],
        'email' => $user['email'],
        'role_name' => $user['role_name'] ?? 'Admin',
    ];

    return true;
}

function logout(): void
{
    unset($_SESSION['user']);
    session_regenerate_id(true);
}
