<?php

declare(strict_types=1);

function db(): ?PDO
{
    global $pdo;

    return $pdo instanceof PDO ? $pdo : null;
}

function app_url(string $path = ''): string
{
    return rtrim(APP_URL, '/') . '/' . ltrim($path, '/');
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect_to(string $path): void
{
    header('Location: ' . app_url($path));
    exit;
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash(): ?array
{
    if (! isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $token = $_POST['csrf_token'] ?? '';

    if (! hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        set_flash('danger', 'Session invalide. Veuillez reessayer.');
        redirect_back();
    }
}

function redirect_back(): void
{
    $target = $_SERVER['HTTP_REFERER'] ?? app_url();
    header('Location: ' . $target);
    exit;
}

function old(string $key, string $default = ''): string
{
    return $_SESSION['old'][$key] ?? $default;
}

function flash_old_input(): void
{
    $_SESSION['old'] = $_POST;
}

function clear_old_input(): void
{
    unset($_SESSION['old']);
}

function is_post(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

function fetch_all_assoc(PDOStatement $stmt): array
{
    return $stmt->fetchAll();
}

function fetch_one_assoc(PDOStatement $stmt): ?array
{
    $row = $stmt->fetch();

    return $row ?: null;
}

function count_table(string $table): int
{
    $allowed = [
        'members',
        'adhesion_requests',
        'events',
        'payments',
        'posts',
        'partners',
        'documents',
        'contact_messages',
    ];

    if (! in_array($table, $allowed, true) || ! db()) {
        return 0;
    }

    $query = db()->query("SELECT COUNT(*) AS total FROM {$table}");
    $row = $query->fetch();

    return (int) ($row['total'] ?? 0);
}

function sum_payments_by_status(string $status): float
{
    if (! db()) {
        return 0;
    }

    $stmt = db()->prepare('SELECT COALESCE(SUM(amount), 0) AS total FROM payments WHERE status = ?');
    $stmt->execute([$status]);
    $row = fetch_one_assoc($stmt);

    return (float) ($row['total'] ?? 0);
}

function fetch_latest_posts(int $limit = 3): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->prepare('SELECT id, title, excerpt, category, image_path, published_at, slug FROM posts WHERE status = ? ORDER BY published_at DESC LIMIT ?');
    $stmt->bindValue(1, 'published');
    $stmt->bindValue(2, $limit, PDO::PARAM_INT);
    $stmt->execute();
    $items = fetch_all_assoc($stmt);

    return $items;
}

function fetch_upcoming_events(int $limit = 3): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->prepare('SELECT id, title, description, starts_at, location, capacity, image_path FROM events WHERE starts_at >= CURDATE() ORDER BY starts_at ASC LIMIT ?');
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    $items = fetch_all_assoc($stmt);

    return $items;
}

function fetch_leadership(): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->prepare('SELECT full_name, role_title, bio, avatar_path, mandate_start, mandate_end FROM team_members WHERE is_active = 1 ORDER BY display_order ASC');
    $stmt->execute();
    $items = fetch_all_assoc($stmt);

    return $items;
}

function fetch_membership_requests(): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->prepare('SELECT id, full_name, university, phone, email, review_status, created_at FROM adhesion_requests ORDER BY created_at DESC');
    $stmt->execute();
    $items = fetch_all_assoc($stmt);

    return $items;
}

function fetch_members(): array
{
    if (! db()) {
        return [];
    }

    $query = '
        SELECT m.member_number, m.status, m.university, u.full_name, u.email
        FROM members m
        INNER JOIN users u ON u.id = m.user_id
        ORDER BY m.id DESC
    ';
    $stmt = db()->query($query);

    return $stmt->fetchAll();
}

function fetch_contact_messages(): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->query('SELECT name, email, subject, status, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 10');

    return $stmt->fetchAll();
}

function fetch_posts_page(): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->query("SELECT title, excerpt, category, image_path, slug, published_at FROM posts WHERE status = 'published' ORDER BY published_at DESC");

    return $stmt->fetchAll();
}

function fetch_post_by_slug(string $slug): ?array
{
    if (! db()) {
        return null;
    }

    $stmt = db()->prepare('SELECT title, excerpt, body, category, image_path, published_at FROM posts WHERE slug = ? LIMIT 1');
    $stmt->execute([$slug]);
    $post = fetch_one_assoc($stmt);

    return $post;
}
