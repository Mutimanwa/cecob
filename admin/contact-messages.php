<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$pageTitle = 'CECOB | Messages contact';
$adminPage = 'contact';
$messages = fetch_contact_messages();

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4"><div class="mb-4"><h1 class="h2 mb-1">Messages de contact</h1><p class="mb-0 text-muted">Suivi des messages soumis depuis le site public.</p></div><div class="card"><div class="card-body"><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Nom</th><th>Email</th><th>Objet</th><th>Statut</th><th>Date</th></tr></thead><tbody><?php foreach ($messages as $message): ?><tr><td><?= e($message['name']); ?></td><td><?= e($message['email']); ?></td><td><?= e($message['subject']); ?></td><td><?= e($message['status']); ?></td><td><?= e($message['created_at']); ?></td></tr><?php endforeach; ?></tbody></table></div></div></div></section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>

