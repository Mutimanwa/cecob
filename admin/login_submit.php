<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (! is_post()) {
    redirect_to('admin/sign-in.php');
}

verify_csrf();

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($email === '' || $password === '') {
    set_flash('danger', 'Email et mot de passe requis.');
    redirect_to('admin/sign-in.php');
}

if (attempt_login($email, $password)) {
    set_flash('success', 'Connexion reussie.');
    redirect_to('admin/dashboard.php');
}

set_flash('danger', 'Identifiants invalides.');
redirect_to('admin/sign-in.php');

