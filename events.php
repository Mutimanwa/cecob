<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CECOB | Événements & Activités';
$currentPage = 'events';

// Filter by category
$activeCategory = $_GET['category'] ?? null;
$events = fetch_upcoming_events(12, $activeCategory);

// Fetch categories for tabs
$allCategories = fetch_all_assoc(db()->query("SELECT DISTINCT category FROM events WHERE starts_at >= CURDATE()"));

require_once __DIR__ . '/includes/public_header.php';
?>
<main>
    <section class="py-8 bg-light">
        <div class="container text-center">
            <span class="text-uppercase text-primary fw-semibold ls-md">Agenda Communautaire</span>
            <h1 class="display-4 fw-bold mt-3">Événements et Activités à venir</h1>
            <p class="lead mb-0">Participez à la vie de la communauté CECOB à travers nos rencontres, conférences et activités culturelles.</p>
        </div>
    </section>

    <section class="py-7">
        <div class="container">
            <!-- Category Tabs -->
            <ul class="nav nav-line-bottom mb-6 justify-content-center">
                <li class="nav-item">
                    <a class="nav-link <?= !$activeCategory ? 'active' : ''; ?>" href="events.php">Tout l'agenda</a>
                </li>
                <?php foreach ($allCategories as $cat): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $activeCategory === $cat['category'] ? 'active' : ''; ?>"
                            href="events.php?category=<?= urlencode($cat['category']); ?>">
                            <?= e($cat['category']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="row g-4">
                <?php if (empty($events)): ?>
                    <div class="col-12 text-center py-5">
                        <i class="fe fe-calendar display-4 text-muted mb-3 d-block"></i>
                        <p class="lead">Aucun événement prévu prochainement dans cette catégorie.</p>
                        <a href="events.php" class="btn btn-outline-primary">Voir tout l'agenda</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card h-100 shadow-sm card-hover">
                                <img src="<?= e($event['image_path'] ?: 'uploads/events/blogpost-1.jpg'); ?>"
                                    class="card-img-top" alt="<?= e($event['title']); ?>" style="height: 200px; object-fit: cover;" />
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge bg-primary-soft text-primary"><?= e($event['category'] ?? 'Événement'); ?></span>
                                        <span class="ms-auto small text-muted">
                                            <i class="fe fe-calendar me-1"></i> <?= e(date('d/m/Y', strtotime($event['starts_at']))); ?>
                                        </span>
                                    </div>
                                    <h3 class="h4 mt-2"><?= e($event['title']); ?></h3>
                                    <div class="mb-3">
                                        <i class="fe fe-map-pin text-muted me-1"></i>
                                        <span class="small text-muted"><?= e($event['location']); ?></span>
                                    </div>
                                    <p class="text-muted mb-0 small text-truncate-3"><?= e($event['description']); ?></p>
                                </div>
                                <div class="card-footer bg-white border-top-0 pt-0 pb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-muted">
                                            <i class="fe fe-users me-1"></i> <?= (int)$event['capacity'] > 0 ? (int)$event['capacity'] . ' places' : 'Accès libre'; ?>
                                        </span>
                                        <a href="events.php" class="btn btn-sm btn-outline-primary">Détails</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/includes/public_footer.php'; ?>