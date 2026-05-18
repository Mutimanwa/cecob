<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$pageTitle = 'CECOB | Dashboard';
$adminPage = 'dashboard';

// Fetch stats
$stats = [
  'members' => count_table('members'),
  'requests' => count_table('adhesion_requests'),
  'posts' => count_table('posts'),
  'events' => count_table('events'),
  'partners' => count_table('partners'),
  'paid' => sum_payments_by_status('paid'),
  'pending_pay' => sum_payments_by_status('pending'),
];

// Fetch recent activity
$recent_posts = fetch_recent_records('posts', 5);
$recent_messages = fetch_recent_records('contact_messages', 5);
$recent_requests = fetch_membership_requests('pending'); // only pending for actionable view

require_once __DIR__ . '/../includes/admin_header.php';
?>

<section class="container-fluid p-4">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
        <div class="d-flex flex-column gap-1">
          <h1 class="mb-0 h2 fw-bold">Tableau de Bord</h1>
          <p class="mb-0 text-muted">Bienvenue, <?= e($_SESSION['user_name'] ?? 'Admin'); ?>. Voici l'état actuel de votre plateforme.</p>
        </div>
        <div class="d-flex gap-2">
          <a href="post-add.php" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="fe fe-plus"></i> Nouvel Article
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Row -->
  <div class="row g-4 mb-4">
    <div class="col-xl-3 col-lg-6 col-md-12 col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="mb-0">Membres Actifs</h4>
            </div>
            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
              <i class="fe fe-users fs-4"></i>
            </div>
          </div>
          <div>
            <h1 class="fw-bold"><?= $stats['members']; ?></h1>
            <p class="mb-0 text-muted"><span class="text-dark fw-semi-bold"><?= $stats['requests']; ?></span> demandes en attente</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="mb-0">Articles Publiés</h4>
            </div>
            <div class="icon-shape icon-md bg-light-success text-success rounded-2">
              <i class="fe fe-book-open fs-4"></i>
            </div>
          </div>
          <div>
            <h1 class="fw-bold"><?= $stats['posts']; ?></h1>
            <p class="mb-0 text-muted"><span class="text-dark fw-semi-bold"><?= $stats['events']; ?></span> Événements programmés</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="mb-0">Trésorerie (Validée)</h4>
            </div>
            <div class="icon-shape icon-md bg-light-info text-info rounded-2">
              <i class="fe fe-dollar-sign fs-4"></i>
            </div>
          </div>
          <div>
            <h1 class="fw-bold"><?= number_format($stats['paid'], 0, ',', ' '); ?> <small class="fs-6 fw-normal">BIF</small></h1>
            <p class="mb-0 text-muted"><span class="text-danger fw-semi-bold"><?= number_format($stats['pending_pay'], 0, ',', ' '); ?></span> en attente</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="mb-0">Partenaires</h4>
            </div>
            <div class="icon-shape icon-md bg-light-warning text-warning rounded-2">
              <i class="fe fe-briefcase fs-4"></i>
            </div>
          </div>
          <div>
            <h1 class="fw-bold"><?= $stats['partners']; ?></h1>
            <p class="mb-0 text-muted">Institutions et sponsors</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <!-- Recent Posts -->
    <div class="col-xl-8 col-lg-12 col-md-12 col-12">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
          <h4 class="mb-0">Derniers Articles</h4>
          <a href="posts.php" class="btn btn-outline-secondary btn-sm">Tout voir</a>
        </div>
        <div class="table-responsive">
          <table class="table mb-0 text-nowrap table-centered table-hover">
            <thead class="table-light">
              <tr>
                <th>Article</th>
                <th>Catégorie</th>
                <th>Date</th>
                <th>Statut</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recent_posts as $p): ?>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="<?= e(app_url($p['image_path'] ?: 'assets/images/placeholder.jpg')); ?>" alt="" class="rounded img-4by3-sm">
                      <div class="ms-3">
                        <h5 class="mb-0"><a href="post-add.php?id=<?= $p['id']; ?>" class="text-inherit"><?= e($p['title']); ?></a></h5>
                      </div>
                    </div>
                  </td>
                  <td><?= e($p['category']); ?></td>
                  <td><?= date('d/m/Y', strtotime($p['published_at'])); ?></td>
                  <td>
                    <span class="badge bg-<?= $p['status'] === 'published' ? 'success' : 'warning'; ?>-soft">
                      <?= ucfirst($p['status']); ?>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Recent Contact Messages -->
    <div class="col-xl-4 col-lg-12 col-md-12 col-12">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
          <h4 class="mb-0">Messages Récents</h4>
          <a href="messages.php" class="btn btn-outline-secondary btn-sm">Tout voir</a>
        </div>
        <ul class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
          <?php if (empty($recent_messages)): ?>
            <li class="list-group-item text-center py-4">Aucun message pour le moment.</li>
          <?php endif; ?>
          <?php foreach ($recent_messages as $m): ?>
            <li class="list-group-item">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <div class="ms-0">
                    <h5 class="mb-0"><?= e($m['name']); ?></h5>
                    <p class="mb-0 small text-muted text-truncate" style="max-width: 150px;"><?= e($m['subject']); ?></p>
                  </div>
                </div>
                <div>
                  <span class="badge rounded-pill bg-light-<?= $m['status'] === 'new' ? 'danger' : 'secondary'; ?> text-<?= $m['status'] === 'new' ? 'danger' : 'secondary'; ?>">
                    <?= ucfirst($m['status']); ?>
                  </span>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>