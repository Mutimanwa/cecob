<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = (int) ($_GET['id'] ?? 0);
    if (delete_record('partners', $id)) {
        set_flash('success', 'Partenaire supprime.');
    } else {
        set_flash('danger', 'Erreur lors de la suppression.');
    }
    redirect_to('admin/partners.php');
}

$pageTitle = 'CECOB | Partenaires';
$adminPage = 'partners';
$partners = fetch_all_partners();

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column gap-1">
                    <h1 class="mb-0 h2 fw-bold">Partenaires</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Partenaires</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="partners-add.php" class="btn btn-primary">Ajouter un partenaire</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card rounded-3">
                <div class="table-responsive">
                    <table class="table mb-0 text-nowrap table-centered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Partenaire</th>
                                <th>Site Web</th>
                                <th>Date Ajout</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($partners as $p): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= e(app_url($p['logo_path'] ?: 'uploads/blog/blogpost-1.jpg')); ?>" alt="" class="img-4by3-sm me-3" />
                                            <h5 class="mb-0"><?= e($p['name']); ?></h5>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($p['website_url']): ?>
                                            <a href="<?= e($p['website_url']); ?>" target="_blank"><?= e($p['website_url']); ?></a>
                                        <?php else: ?>
                                            <span class="text-muted">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($p['created_at'])); ?></td>
                                    <td>
                                        <span class="dropdown dropstart">
                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu">
                                                <a class="dropdown-item" href="partners-add.php?id=<?= $p['id']; ?>">
                                                    <i class="fe fe-edit dropdown-item-icon"></i> Modifier
                                                </a>
                                                <a class="dropdown-item text-danger" href="?action=delete&id=<?= $p['id']; ?>" onclick="return confirm('Supprimer ce partenaire ?')">
                                                    <i class="fe fe-trash dropdown-item-icon"></i> Supprimer
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