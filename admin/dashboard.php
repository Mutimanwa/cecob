<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$pageTitle = 'CECOB | Dashboard';
$adminPage = 'dashboard';
$pendingAmount = sum_payments_by_status('pending');
$paidAmount = sum_payments_by_status('paid');
$messages = fetch_contact_messages();

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
  <div class="row mb-4"><div class="col-12"><h1 class="h2 mb-1">Dashboard CECOB</h1><p class="mb-0 text-muted">Vue d’ensemble procedurale connectee a MySQL.</p></div></div>
  <div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6"><div class="card border-0 shadow-sm"><div class="card-body"><span class="text-muted">Total membres</span><h2 class="mt-2 mb-1"><?= count_table('members'); ?></h2></div></div></div>
    <div class="col-xl-3 col-md-6"><div class="card border-0 shadow-sm"><div class="card-body"><span class="text-muted">Adhesions en attente</span><h2 class="mt-2 mb-1"><?= count_table('adhesion_requests'); ?></h2></div></div></div>
    <div class="col-xl-3 col-md-6"><div class="card border-0 shadow-sm"><div class="card-body"><span class="text-muted">Paiements valides</span><h2 class="mt-2 mb-1"><?= number_format($paidAmount, 0, ',', ' '); ?> BIF</h2></div></div></div>
    <div class="col-xl-3 col-md-6"><div class="card border-0 shadow-sm"><div class="card-body"><span class="text-muted">Paiements en attente</span><h2 class="mt-2 mb-1"><?= number_format($pendingAmount, 0, ',', ' '); ?> BIF</h2></div></div></div>
  </div>
  <div class="card"><div class="card-header"><h4 class="mb-0">Derniers messages de contact</h4></div><div class="card-body"><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Nom</th><th>Email</th><th>Objet</th><th>Statut</th><th>Date</th></tr></thead><tbody><?php foreach ($messages as $message): ?><tr><td><?= e($message['name']); ?></td><td><?= e($message['email']); ?></td><td><?= e($message['subject']); ?></td><td><?= e($message['status']); ?></td><td><?= e($message['created_at']); ?></td></tr><?php endforeach; ?></tbody></table></div></div></div>
</section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>

