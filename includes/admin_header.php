<?php
$pageTitle = $pageTitle ?? 'Dashboard CECOB';
$adminPage = $adminPage ?? '';
$flash = get_flash();
$user = current_user();
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="<?= e(app_url('assets/images/favicon/favicon.ico')); ?>" />
    <script src="<?= e(app_url('assets/js/vendors/darkMode.js')); ?>"></script>
    <link href="<?= e(app_url('assets/fonts/feather/feather.css')); ?>" rel="stylesheet" />
    <link href="<?= e(app_url('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')); ?>" rel="stylesheet" />
    <link href="<?= e(app_url('assets/libs/simplebar/dist/simplebar.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= e(app_url('assets/css/theme.min.css')); ?>" />
    <title><?= e($pageTitle); ?></title>
  </head>
  <body>
    <div id="db-wrapper">
      <nav class="navbar-vertical navbar">
        <div class="vh-100" data-simplebar>
          <a class="navbar-brand" href="<?= e(app_url('index.php')); ?>"><img src="<?= e(app_url('assets/images/brand/logo/logo-inverse.svg')); ?>" alt="CECOB" /></a>
          <ul class="navbar-nav flex-column">
            <li class="nav-item"><a class="nav-link <?= $adminPage === 'dashboard' ? 'active' : ''; ?>" href="<?= e(app_url('admin/dashboard.php')); ?>"><i class="nav-icon fe fe-home me-2"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link <?= $adminPage === 'members' ? 'active' : ''; ?>" href="<?= e(app_url('admin/members.php')); ?>"><i class="nav-icon fe fe-users me-2"></i>Membres</a></li>
            <li class="nav-item"><a class="nav-link <?= $adminPage === 'adhesions' ? 'active' : ''; ?>" href="<?= e(app_url('admin/membership-requests.php')); ?>"><i class="nav-icon fe fe-user-plus me-2"></i>Adhesions</a></li>
            <li class="nav-item"><a class="nav-link <?= $adminPage === 'contact' ? 'active' : ''; ?>" href="<?= e(app_url('admin/contact-messages.php')); ?>"><i class="nav-icon fe fe-mail me-2"></i>Contacts</a></li>
          </ul>
        </div>
      </nav>
      <main id="page-content">
        <div class="header">
          <nav class="navbar-default navbar navbar-expand-lg">
            <a id="nav-toggle" href="#"><i class="fe fe-menu"></i></a>
            <div class="ms-auto d-flex align-items-center gap-3">
              <?php if ($user): ?>
                <span class="text-muted small"><?= e($user['full_name']); ?> · <?= e($user['role_name']); ?></span>
              <?php endif; ?>
              <a href="<?= e(app_url('admin/logout.php')); ?>" class="btn btn-outline-dark btn-sm">Deconnexion</a>
            </div>
          </nav>
        </div>
        <?php if ($flash): ?>
          <section class="container-fluid p-4 pb-0">
            <div class="alert alert-<?= e($flash['type']); ?> mb-0"><?= e($flash['message']); ?></div>
          </section>
        <?php endif; ?>

