<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$pageTitle = 'CECOB | Membres';
$adminPage = 'members';
$members = fetch_members();

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="mb-0 h2 fw-bold">Gestion des Membres</h1>
                    <p class="mb-0 text-muted">Liste des membres officiels de l'association.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table mb-0 text-nowrap table-centered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Numero</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Universite</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($members)): ?>
                                <tr>
                                    <td colspan="6" class="text-center p-4">Aucun membre trouve.</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($members as $m): ?>
                                <tr>
                                    <td><span class="fw-bold"><?= e($m['member_number']); ?></span></td>
                                    <td><?= e($m['full_name']); ?></td>
                                    <td><?= e($m['email']); ?></td>
                                    <td><?= e($m['university']); ?></td>
                                    <td>
                                        <span class="badge bg-<?= $m['status'] === 'active' ? 'success' : 'secondary'; ?>-soft">
                                            <?= ucfirst($m['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="dropdown dropstart">
                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu">
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-user dropdown-item-icon"></i> Profil
                                                </a>
                                                <a class="dropdown-item text-danger" href="#">
                                                    <i class="fe fe-slash dropdown-item-icon"></i> Suspendre
                                                </a>
                                            </span>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>