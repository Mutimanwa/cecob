<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$pageTitle = 'CECOB | Adhesions';
$adminPage = 'adhesions';
$requests = fetch_membership_requests();

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4"><div class="mb-4"><h1 class="h2 mb-1">Demandes d’adhesion</h1><p class="mb-0 text-muted">Lecture des dossiers en attente depuis `adhesion_requests`.</p></div><div class="card"><div class="card-body"><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Candidat</th><th>Universite</th><th>Telephone</th><th>Email</th><th>Statut</th><th>Date</th></tr></thead><tbody><?php foreach ($requests as $request): ?><tr><td><?= e($request['full_name']); ?></td><td><?= e($request['university']); ?></td><td><?= e($request['phone']); ?></td><td><?= e($request['email']); ?></td><td><?= e($request['review_status']); ?></td><td><?= e($request['created_at']); ?></td></tr><?php endforeach; ?></tbody></table></div></div></div></section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>

