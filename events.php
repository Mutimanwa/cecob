<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CECOB | Evenements';
$currentPage = 'events';
$events = fetch_upcoming_events(12);
require_once __DIR__ . '/includes/public_header.php';
?>
<main>
    <section class="py-8 bg-light">
        <div class="container">
            <h1 class="display-4 fw-bold">Evenements CECOB</h1>
            <p class="lead mb-0">Listing dynamique depuis la table `events`.</p>
        </div>
    </section>
    <section class="py-8">
        <div class="container">
            <div class="row g-4"><?php foreach ($events as $event): ?><div class="col-lg-4 col-md-6">
                        <div class="card h-100"><img src="<?= e($event['image_path'] ?: 'uploads/events/blogpost-1.jpg'); ?>" class="card-img-top" alt="" />
                            <div class="card-body"><span class="badge bg-primary-subtle text-primary"><?= e(date('d/m/Y', strtotime($event['starts_at']))); ?></span>
                                <h3 class="h4 mt-3"><?= e($event['title']); ?></h3>
                                <p class="mb-2"><?= e($event['location']); ?></p>
                                <p class="mb-0"><?= e($event['description']); ?></p>
                            </div>
                        </div>
                    </div><?php endforeach; ?></div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/includes/public_footer.php'; ?>