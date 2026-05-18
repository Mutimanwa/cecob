<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$id = (int) ($_GET['id'] ?? 0);
$member = null;
if ($id) {
    $stmt = db()->prepare('SELECT * FROM team_members WHERE id = ?');
    $stmt->execute([$id]);
    $member = fetch_one_assoc($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $full_name = $_POST['full_name'] ?? '';
    $role_title = $_POST['role_title'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $mandate_start = $_POST['mandate_start'] ?? '';
    $mandate_end = $_POST['mandate_end'] ?: null;
    $display_order = (int) ($_POST['display_order'] ?? 0);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $avatar_path = $member['avatar_path'] ?? null;

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $uploaded = upload_file($_FILES['avatar'], 'assets/images/team');
        if ($uploaded) {
            $avatar_path = $uploaded;
        }
    }

    $data = [
        'full_name' => $full_name,
        'role_title' => $role_title,
        'bio' => $bio,
        'avatar_path' => $avatar_path,
        'mandate_start' => $mandate_start,
        'mandate_end' => $mandate_end,
        'display_order' => $display_order,
        'is_active' => $is_active
    ];

    if ($id) {
        $data['id'] = $id;
    }

    if (save_team_member($data)) {
        set_flash('success', 'Membre de l\'equipe enregistre.');
        redirect_to('admin/team.php');
    } else {
        set_flash('danger', 'Erreur d\'enregistrement.');
    }
}

$pageTitle = $id ? 'CECOB | Modifier Membre' : 'CECOB | Ajouter Membre';
$adminPage = 'team';
require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="mb-0 h2 fw-bold"><?= $id ? 'Modifier le membre' : 'Ajouter un membre'; ?></h1>
                </div>
                <div>
                    <a href="team.php" class="btn btn-outline-secondary">Retour</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-xl-3 col-xl-6 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">

                        <div class="mb-3">
                            <label class="form-label">Nom Complet</label>
                            <input type="text" name="full_name" class="form-control" value="<?= e($member['full_name'] ?? ''); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role / Titre</label>
                            <input type="text" name="role_title" class="form-control" value="<?= e($member['role_title'] ?? ''); ?>" placeholder="Ex: President, Secretaire" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bio (Optionnel)</label>
                            <textarea name="bio" class="form-control" rows="3"><?= e($member['bio'] ?? ''); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Debut Mandat</label>
                                <input type="number" name="mandate_start" class="form-control" value="<?= e($member['mandate_start'] ?? date('Y')); ?>" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Fin Mandat (Optionnel)</label>
                                <input type="number" name="mandate_end" class="form-control" value="<?= e($member['mandate_end'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ordre d'affichage</label>
                            <input type="number" name="display_order" class="form-control" value="<?= e($member['display_order'] ?? 0); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Avatar</label>
                            <?php if ($member && $member['avatar_path']): ?>
                                <div class="mb-2"><img src="<?= e(app_url($member['avatar_path'])); ?>" class="rounded-circle avatar-md"></div>
                            <?php endif; ?>
                            <input type="file" name="avatar" class="form-control">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="isActive" <?= ($member['is_active'] ?? 1) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="isActive">Membre actif (actuellement en poste)</label>
                        </div>

                        <button type="submit" class="btn btn-primary"><?= $id ? 'Mettre à jour' : 'Ajouter'; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>