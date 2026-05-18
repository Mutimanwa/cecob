<?php
require_once __DIR__ . '/../includes/bootstrap.php';

if (is_logged_in()) {
  redirect_to('admin/dashboard.php');
}

$flash = get_flash();
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico" />
  <script src="../assets/js/vendors/darkMode.js"></script>
  <link href="../assets/fonts/feather/feather.css" rel="stylesheet" />
  <link href="../assets/js/vendors/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="../assets/js/vendors/simplebar/dist/simplebar.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/theme.min.css" />
  <title>CECOB | Connexion admin</title>
</head>

<body>
  <main>
    <section class="container d-flex flex-column vh-100">
      <div class="row align-items-center justify-content-center g-0 h-lg-100 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
          <div class="card shadow">
            <div class="card-body p-6 d-flex flex-column gap-4">
              <div>
                <a href="../index.php"><img src="../assets/images/brand/logo/logo-icon.svg" class="mb-4" alt="logo-icon" /></a>
                <h1 class="mb-0 fw-bold">Connexion admin CECOB</h1>
              </div>
              <?php if ($flash): ?><div class="alert alert-<?= e($flash['type']); ?> mb-0"><?= e($flash['message']); ?></div><?php endif; ?>
              <form method="post" action="login_submit.php">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()); ?>" />
                <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" required /></div>
                <div class="mb-3"><label class="form-label">Mot de passe</label><input type="password" class="form-control" name="password" required /></div>
                <div class="d-grid"><button type="submit" class="btn btn-primary">Se connecter</button></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script src="../assets/js/vendors/@popperjs/core/dist/umd/popper.min.js"></script>
  <script src="../assets/js/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../assets/js/vendors/simplebar/dist/simplebar.min.js"></script>
  <script src="../assets/js/theme.min.js"></script>
</body>

</html>