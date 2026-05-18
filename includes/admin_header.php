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
          <li class="nav-item nav-divider my-2"></li>
          <li class="nav-item">
            <div class="navbar-heading">Contenue</div>
          </li>
          <li class="nav-item"><a class="nav-link <?= $adminPage === 'posts' ? 'active' : ''; ?>" href="<?= e(app_url('admin/posts.php')); ?>"><i class="nav-icon fe fe-book-open me-2"></i>Articles (Blog)</a></li>
          <li class="nav-item"><a class="nav-link <?= $adminPage === 'events' ? 'active' : ''; ?>" href="<?= e(app_url('admin/events.php')); ?>"><i class="nav-icon fe fe-calendar me-2"></i>Evenements</a></li>
             <li class="nav-item nav-divider my-2"></li>
          <li class="nav-item">
            <div class="navbar-heading">Membres</div>
          </li>
          <li class="nav-item"><a class="nav-link <?= $adminPage === 'members' ? 'active' : ''; ?>" href="<?= e(app_url('admin/members.php')); ?>"><i class="nav-icon fe fe-users me-2"></i>Membres</a></li>
          <li class="nav-item"><a class="nav-link <?= $adminPage === 'adhesions' ? 'active' : ''; ?>" href="<?= e(app_url('admin/membership-requests.php')); ?>"><i class="nav-icon fe fe-user-plus me-2"></i>Adhesions</a></li>
             <li class="nav-item nav-divider my-2"></li>
          <li class="nav-item">
            <div class="navbar-heading">Leadarship</div>
          </li>
          <li class="nav-item"><a class="nav-link <?= $adminPage === 'team' ? 'active' : ''; ?>" href="<?= e(app_url('admin/team.php')); ?>"><i class="nav-icon fe fe-briefcase me-2"></i>Equipe</a></li>
          <li class="nav-item"><a class="nav-link <?= $adminPage === 'partners' ? 'active' : ''; ?>" href="<?= e(app_url('admin/partners.php')); ?>"><i class="nav-icon fe fe-shield me-2"></i>Partenaires</a></li>
            <li class="nav-item nav-divider my-2"></li>
          <li class="nav-item">
            <div class="navbar-heading">Messagerie</div>
          </li>
          <li class="nav-item"><a class="nav-link <?= $adminPage === 'contact' ? 'active' : ''; ?>" href="<?= e(app_url('admin/contact-messages.php')); ?>"><i class="nav-icon fe fe-mail me-2"></i>Contacts</a></li>
          <li class="nav-item"><a class="nav-link <?= $adminPage === 'settings' ? 'active' : ''; ?>" href="<?= e(app_url('admin/settings.php')); ?>"><i class="nav-icon fe fe-settings me-2"></i>Parametres</a></li>
        </ul>
      </div>
    </nav>
    <main id="page-content">
      <div class="header">
        <!--  -->
        <nav class="navbar-default navbar navbar-expand-lg">
          <a id="nav-toggle" href="#">
            <i class="fe fe-menu"></i>
          </a>
          <div class="ms-lg-3 d-none d-md-none d-lg-block">
            <!-- Form -->
            <form class="d-flex align-items-center">
              <span class="position-absolute ps-3 search-icon">
                <i class="fe fe-search"></i>
              </span>
              <input type="search" class="form-control ps-6" placeholder="Search Entire Dashboard">
            </form>
          </div>
          <!--Navbar nav -->
          <div class="ms-auto d-flex">
            <div class="dropdown">
              <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                <i class="bi theme-icon-active"><i class="bi theme-icon bi-sun-fill"></i></i>
                <span class="visually-hidden bs-theme-text">Toggle theme</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                    <i class="bi theme-icon bi-sun-fill"></i>
                    <span class="ms-2">Light</span>
                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <i class="bi theme-icon bi-moon-stars-fill"></i>
                    <span class="ms-2">Dark</span>
                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                    <i class="bi theme-icon bi-circle-half"></i>
                    <span class="ms-2">Auto</span>
                  </button>
                </li>
              </ul>
            </div>
            <ul class="navbar-nav navbar-right-wrap ms-2 d-flex nav-top-wrap">
              <li class="dropdown stopevent">
                <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fe fe-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg" aria-labelledby="dropdownNotification">
                  <div>
                    <div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
                      <span class="h4 mb-0">Notifications</span>
                      <a href="# ">
                        <span class="align-middle">
                          <i class="fe fe-settings me-1"></i>
                        </span>
                      </a>
                    </div>
                    <!-- List group -->
                    <ul class="list-group list-group-flush" data-simplebar="init" style="max-height: 300px">
                      <div class="simplebar-wrapper" style="margin: 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                          <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                          <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;">
                              <div class="simplebar-content" style="padding: 0px;">
                                <li class="list-group-item bg-light">
                                  <div class="row">
                                    <div class="col">
                                      <a class="text-body" href="#">
                                        <div class="d-flex">
                                          <img src="assets/images/avatar/avatar-1.jpg" alt="" class="avatar-md rounded-circle">
                                          <div class="ms-3">
                                            <h5 class="fw-bold mb-1">Kristin Watson:</h5>
                                            <p class="mb-3">Krisitn Watsan like your comment on course Javascript Introduction!</p>
                                            <span class="fs-6">
                                              <span>
                                                <span class="fe fe-thumbs-up text-success me-1"></span>
                                                2 hours ago,
                                              </span>
                                              <span class="ms-1">2:19 PM</span>
                                            </span>
                                          </div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-auto text-center me-2">
                                      <a href="#" class="badge-dot bg-info" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark as read" data-bs-original-title="Mark as read"></a>
                                      <div>
                                        <a href="#" class="bg-transparent" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Remove" data-bs-original-title="Remove">
                                          <i class="fe fe-x"></i>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                      </div>
                      <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                      </div>
                      <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
                      </div>
                    </ul>
                    <div class="border-top px-3 pt-3 pb-0">
                      <a href="pages/notification-history.html" class="text-link fw-semibold">See all Notifications</a>
                    </div>
                  </div>
                </div>
              </li>
              <!-- List -->
              <li class="dropdown ms-2">
                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="avatar avatar-md avatar-indicators avatar-online">
                    <img alt="avatar" src="assets/images/avatar/avatar-1.jpg" class="rounded-circle">
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                  <div class="dropdown-item">
                    <div class="d-flex">
                      <div class="avatar avatar-md avatar-indicators avatar-online">
                        <img alt="avatar" src="assets/images/avatar/avatar-1.jpg" class="rounded-circle">
                      </div>
                      <div class="ms-3 lh-1">
                        <h5 class="mb-1"><?= e($user['full_name']) ?></h5>
                        <p class="mb-0"><?= e($user['full_name']) ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown-divider"></div>
                  <ul class="list-unstyled">
                    <li>
                      <a class="dropdown-item" href="<?= e(app_url('admin/profile-edit.php')); ?>">
                        <i class="fe fe-user me-2"></i>
                        Profile
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="fe fe-settings me-2"></i>
                        Settings
                      </a>
                    </li>
                  </ul>
                  <div class="dropdown-divider"></div>
                  <ul class="list-unstyled">
                    <li>
                      <a class="dropdown-item" href="<?= e(app_url('admin/logout.php')); ?>">
                        <i class="fe fe-power me-2"></i>
                        Déconnecter
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <!--  -->
      </div>
      <?php if ($flash): ?>
        <section class="container-fluid p-4 pb-0">
          <div class="alert alert-<?= e($flash['type']); ?> mb-0"><?= e($flash['message']); ?></div>
        </section>
      <?php endif; ?>