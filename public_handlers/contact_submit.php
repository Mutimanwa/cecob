<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (! is_post()) {
    redirect_to('contact.php');
}

verify_csrf();
flash_old_input();

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $phone === '' || $subject === '' || $message === '') {
    set_flash('danger', 'Tous les champs du formulaire de contact sont obligatoires.');
    redirect_to('contact.php');
}

if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    set_flash('danger', 'Veuillez fournir une adresse email valide.');
    redirect_to('contact.php');
}

if (! db()) {
    set_flash('warning', 'Base de donnees indisponible. Verifiez votre configuration MySQL.');
    redirect_to('contact.php');
}

$stmt = db()->prepare('INSERT INTO contact_messages (name, email, phone, subject, message, status, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())');
$stmt->execute([$name, $email, $phone, $subject, $message, 'new']);

clear_old_input();
set_flash('success', 'Votre message a bien ete envoye a CECOB.');
redirect_to('contact.php');
