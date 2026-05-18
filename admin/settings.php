<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

// Settings usually stored in a options table, but for simplicity let's assume we use a JSON file or just one row in a 'site_settings' table.
// If 'site_settings' table doesn't exist, I'll stick to basic form.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    // Implementation for saving settings would go here.
    // For now, just a flash message.
    set_flash('success', 'Parametres mis à jour (Simule).');
    redirect_to('admin/settings.php');
}

$pageTitle = 'CECOB | Parametres';
$adminPage = 'settings';

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="h2 fw-bold">Parametres du Site</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Informations Generales</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
                        <div class="mb-3">
                            <label class="form-label">Nom de l'Organisation</label>
                            <input type="text" class="form-control" value="CECOB" name="site_name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email de Contact</label>
                            <input type="email" class="form-control" value="contact@cecob.org" name="contact_email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telephone</label>
                            <input type="text" class="form-control" value="+257 00 00 00 00" name="contact_phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse Physique</label>
                            <textarea class="form-control" rows="2" name="address">Bujumbura, Burundi</textarea>
                        </div>
                        <hr>
                        <h4 class="mb-3">Reseaux Sociaux</h4>
                        <div class="mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="url" class="form-control" value="https://facebook.com/cecob" name="fb_url">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Twitter / X</label>
                            <input type="url" class="form-control" value="https://twitter.com/cecob" name="twitter_url">
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-danger-soft">
                    <h4 class="mb-0 text-danger">Actions de Securite</h4>
                </div>
                <div class="card-body">
                    <p>Mettre le site en maintenance ou purger le cache.</p>
                    <button class="btn btn-outline-danger">Activer Mode Maintenance</button>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-12">
            <div class="card mb-4">
                <div class="card-header border-bottom-0">
                    <h4 class="mb-0">Logo & Branding</h4>
                </div>
                <div class="card-body text-center">
                    <img src="<?= e(app_url('assets/images/brand/logo/logo.svg')); ?>" alt="" class="mb-3" style="max-height: 80px;">
                    <div class="mb-3">
                        <input type="file" class="form-control form-control-sm">
                    </div>
                    <button class="btn btn-outline-primary btn-sm">Changer le Logo</button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>