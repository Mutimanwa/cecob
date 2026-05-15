<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (! is_post()) {
    redirect_to('membership.php');
}

verify_csrf();
flash_old_input();

$fullName = trim($_POST['full_name'] ?? '');
$gender = trim($_POST['gender'] ?? '');
$birthDate = trim($_POST['birth_date'] ?? '');
$nationality = trim($_POST['nationality'] ?? '');
$university = trim($_POST['university'] ?? '');
$faculty = trim($_POST['faculty'] ?? '');
$department = trim($_POST['department'] ?? '');
$academicLevel = trim($_POST['academic_level'] ?? '');
$studentId = trim($_POST['student_id'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = trim($_POST['password'] ?? '');
$supportingDocuments = trim($_POST['supporting_documents'] ?? '');

if (
    $fullName === '' || $gender === '' || $birthDate === '' || $nationality === '' || $university === '' ||
    $faculty === '' || $department === '' || $academicLevel === '' || $studentId === '' || $email === '' ||
    $phone === '' || $password === ''
) {
    set_flash('danger', 'Veuillez completer tous les champs obligatoires du dossier d’adhesion.');
    redirect_to('membership.php');
}

if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    set_flash('danger', 'Adresse email invalide.');
    redirect_to('membership.php');
}

if (strlen($password) < 8) {
    set_flash('danger', 'Le mot de passe doit contenir au moins 8 caracteres.');
    redirect_to('membership.php');
}

if (! db()) {
    set_flash('warning', 'Base de donnees indisponible. Verifiez votre configuration MySQL.');
    redirect_to('membership.php');
}

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

$stmt = db()->prepare(
    'INSERT INTO adhesion_requests (
        full_name, gender, birth_date, nationality, university, faculty, department, academic_level,
        student_id, email, phone, password_hash, supporting_documents, review_status, created_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())'
);
$stmt->execute([
    $fullName,
    $gender,
    $birthDate,
    $nationality,
    $university,
    $faculty,
    $department,
    $academicLevel,
    $studentId,
    $email,
    $phone,
    $passwordHash,
    $supportingDocuments,
    'pending',
]);

clear_old_input();
set_flash('success', 'Votre demande d’adhesion a ete enregistree et sera analysee par le secretariat.');
redirect_to('membership.php');
