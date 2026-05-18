<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$id = (int) ($_GET['id'] ?? 0);
$partner = null;
if ($id) {
    $stmt = db()->prepare('SELECT * FROM partners WHERE id = ?');
    $stmt->execute([$id]);
    $partner = fetch_one_assoc($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $website_url = $_POST['website_url'] ?? '';
    $logo_path = $partner['logo_path'] ?? null;

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $uploaded = upload_file($_FILES['logo'], 'assets/images/partners');
        if ($uploaded) {
            $logo_path = $uploaded;
        }
    }

    $data = [
        'name' => $name,
        'description' => $description,
        'logo_path' => $logo_path,
        'website_url' => $website_url
    ];

    if ($id) {
        $data['id'] = $id;
    }

    if (save_partner($data)) {
        set_flash('success', 'Partenaire enregistre.');
        redirect_to('admin/partners.php');
    } else {
        set_flash('danger', 'Erreur d\'enregistrement.');
    }
}

$pageTitle = $id ? 'CECOB | Modifier Partenaire' : 'CECOB | Ajouter Partenaire';
$adminPage = 'partners';
require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="mb-0 h2 fw-bold"><?= $id ? 'Modifier partenaire' : 'Ajouter un partenaire'; ?></h1>
                </div>
                <div>
                    <a href="partners.php" class="btn btn-outline-secondary">Retour</a>
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
                            <label class="form-label">Nom du partenaire</label>
                            <input type="text" name="name" class="form-control" value="<?= e($partner['name'] ?? ''); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description (Optionnel)</label>
                            <textarea name="description" class="form-control" rows="3"><?= e($partner['description'] ?? ''); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">URL Site Web</label>
                            <input type="url" name="website_url" class="form-control" value="<?= e($partner['website_url'] ?? ''); ?>" placeholder="https://">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <?php if ($partner && $partner['logo_path']): ?>
                                <div class="mb-2"><img src="<?= e(app_url($partner['logo_path'])); ?>" style="max-height: 100px;"></div>
                            <?php endif; ?>
                            <input type="file" name="logo" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary"><?= $id ? 'Mettre à jour' : 'Ajouter'; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>