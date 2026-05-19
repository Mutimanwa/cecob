<?php
$pageTitle = $pageTitle ?? APP_NAME;
$currentPage = $currentPage ?? '';
$flash = get_flash();
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" type="image/x-icon" href="<?= e(app_url('assets/images/logo.png')); ?>" />
  <script src="<?= e(app_url('assets/js/vendors/darkMode.js')); ?>"></script>
  <link href="<?= e(app_url('assets/fonts/feather/feather.css')); ?>" rel="stylesheet" />
  <link href="<?= e(app_url('assets/js/vendors/bootstrap-icons/font/bootstrap-icons.min.css')); ?>" rel="stylesheet" />
  <link href="<?= e(app_url('assets/js/vendors/simplebar/dist/simplebar.min.css')); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?= e(app_url('assets/js/vendors/bs-stepper/dist/css/bs-stepper.min.css')); ?>">
  <link rel="stylesheet" href="<?= e(app_url('assets/css/theme.min.css')); ?>" />
  <title><?= e($pageTitle); ?></title>
</head>

<body class="bg-white">

  <!--  -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container px-0">
      <a class="navbar-brand" href="<?= e(app_url('index.php')); ?>"><img
          src="<?= e(app_url('assets/images/logo.png')); ?>" alt="CECOB" width="100" /></a>
      <div class="d-flex align-items-center order-lg-3">
        <div class="d-flex align-items-center">
          <div class="dropdown me-2">
            <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center" type="button"
              aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
              <i class="bi theme-icon-active"></i>
              <span class="visually-hidden bs-theme-text">Toggle theme</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
              <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                  aria-pressed="false">
                  <i class="bi theme-icon bi-sun-fill"></i>
                  <span class="ms-2">Clair</span>
                </button>
              </li>
              <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                  aria-pressed="false">
                  <i class="bi theme-icon bi-moon-stars-fill"></i>
                  <span class="ms-2">Sombre</span>
                </button>
              </li>
              <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                  aria-pressed="true">
                  <i class="bi theme-icon bi-circle-half"></i>
                  <span class="ms-2">Auto</span>
                </button>
              </li>
            </ul>
          </div>
          <div class="d-none d-md-block me-2">
            <a href="<?= e(app_url('membership.php')); ?>" class="btn btn-primary <?= $currentPage === 'adhesion'; ?>">Adhesion</a>
          </div>
        </div>
        <div>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="icon-bar top-bar mt-0"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
          </button>
        </div>
      </div>
      <!-- Button -->

      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="navbar-default">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link <?= $currentPage === 'home' ? 'active' : ''; ?>"
              href="<?= e(app_url('index.php')); ?>">Accueil</a></li>
          <li class="nav-item"><a class="nav-link <?= $currentPage === 'about' ? 'active' : ''; ?>"
              href="<?= e(app_url('about.php')); ?>">A propos</a></li>
          <li class="nav-item"><a class="nav-link <?= $currentPage === 'events' ? 'active' : ''; ?>"
              href="<?= e(app_url('events.php')); ?>">Evenements</a></li>
          <li class="nav-item"><a class="nav-link <?= $currentPage === 'blog' ? 'active' : ''; ?>"
              href="<?= e(app_url('blog.php')); ?>">Blog</a></li>
          <li class="nav-item"><a class="nav-link <?= $currentPage === 'gallery' ? 'active' : ''; ?>"
              href="<?= e(app_url('gallery.php')); ?>">Galerie</a></li>
          <li class="nav-item"><a class="nav-link <?= $currentPage === 'contact' ? 'active' : ''; ?>"
              href="<?= e(app_url('contact.php')); ?>">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <?php if ($flash): ?>
    <div class="container mt-4">
      <div class="alert alert-<?= e($flash['type']); ?> mb-0"><?= e($flash['message']); ?></div>
    </div>
  <?php endif; ?>
  <!--  -->