<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CECOB | Leadership';
$currentPage = 'leadership';
$leaders = fetch_leadership();
require_once __DIR__ . '/includes/public_header.php';
?>
<main>
    <section class="py-8 bg-light">
        <div class="container text-center"><span class="text-uppercase text-primary fw-semibold ls-md">Equipe dirigeante</span>
            <h1 class="display-4 fw-bold mt-3">Leadership, commissions et comites officiels</h1>
        </div>
    </section>
    <section class="py-8">
        <div class="container">
            <div class="row g-4"><?php foreach ($leaders as $leader): ?><div class="col-lg-3 col-md-6">
                        <div class="card h-100 text-center">
                            <div class="card-body p-4"><img src="<?= e($leader['avatar_path'] ?: 'uploads/team/avatar-1.jpg'); ?>" class="rounded-circle avatar avatar-xxl" alt="" />
                                <h3 class="h4 mt-4 mb-1"><?= e($leader['full_name']); ?></h3>
                                <p class="text-primary mb-2"><?= e($leader['role_title']); ?></p>
                                <p class="small text-muted"><?= e($leader['bio']); ?></p>
                                <p class="mb-0 small">Mandat: <?= e($leader['mandate_start']); ?> - <?= e($leader['mandate_end']); ?></p>
                            </div>
                        </div>
                    </div><?php endforeach; ?></div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/includes/public_footer.php'; ?>