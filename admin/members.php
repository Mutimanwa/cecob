<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$pageTitle = 'CECOB | Membres';
$adminPage = 'members';
$members = fetch_members();

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4"><div class="mb-4"><h1 class="h2 mb-1">Gestion des membres</h1><p class="mb-0 text-muted">Liste connectee a `users` et `members`.</p></div><div class="card"><div class="card-body"><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Nom</th><th>Email</th><th>Numero</th><th>Universite</th><th>Statut</th></tr></thead><tbody><?php foreach ($members as $member): ?><tr><td><?= e($member['full_name']); ?></td><td><?= e($member['email']); ?></td><td><?= e($member['member_number']); ?></td><td><?= e($member['university']); ?></td><td><?= e($member['status']); ?></td></tr><?php endforeach; ?></tbody></table></div></div></div></section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>

