<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = (int) ($_GET['id'] ?? 0);
    if (delete_record('team_members', $id)) {
        set_flash('success', 'Membre de l\'equipe supprime.');
    } else {
        set_flash('danger', 'Erreur lors de la suppression.');
    }
    redirect_to('admin/team.php');
}

$pageTitle = 'CECOB | Equipe';
$adminPage = 'team';
$team = fetch_all_team();

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column gap-1">
                    <h1 class="mb-0 h2 fw-bold">Gestion de l'Equipe</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Equipe</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="team-add.php" class="btn btn-primary">Ajouter un membre</a>
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
                                <th>Membre</th>
                                <th>Role</th>
                                <th>Mandat</th>
                                <th>Ordre</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($team as $m): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= e(app_url($m['avatar_path'] ?: 'uploads/team/avatar-1.jpg')); ?>" alt="" class="rounded-circle avatar-sm me-3" />
                                            <h5 class="mb-0"><?= e($m['full_name']); ?></h5>
                                        </div>
                                    </td>
                                    <td><?= e($m['role_title']); ?></td>
                                    <td><?= e($m['mandate_start']); ?> - <?= e($m['mandate_end'] ?: 'Present'); ?></td>
                                    <td><?= e($m['display_order']); ?></td>
                                    <td>
                                        <span class="badge bg-<?= $m['is_active'] ? 'success' : 'secondary'; ?>-soft">
                                            <?= $m['is_active'] ? 'Actif' : 'Inactif'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="dropdown dropstart">
                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu">
                                                <a class="dropdown-item" href="team-add.php?id=<?= $m['id']; ?>">
                                                    <i class="fe fe-edit dropdown-item-icon"></i> Modifier
                                                </a>
                                                <a class="dropdown-item text-danger" href="?action=delete&id=<?= $m['id']; ?>" onclick="return confirm('Retirer ce membre de l\'equipe ?')">
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