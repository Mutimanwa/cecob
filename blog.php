<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CECOB | Actualites';
$currentPage = 'blog';
$posts = fetch_posts_page();
require_once __DIR__ . '/includes/public_header.php';
?>
<main>
    <section class="py-7 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10 col-12 text-center">
                    <h1 class="display-4 fw-bold">Actualites et communiques CECOB</h1>
                    <p class="lead">Publications dynamiques depuis le module de contenu.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-8 pt-6">
        <div class="container">
            <div class="row g-4"><?php foreach ($posts as $post): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm"><a
                                href="<?= e(app_url('article.php?slug=' . urlencode($post['slug']))); ?>"><img
                                    src="<?= e($post['image_path'] ?: 'assets/images/blog/blogpost-1.jpg'); ?>"
                                    class="card-img-top" alt="" /></a>
                            <div class="card-body"><span
                                    class="fs-6 fw-semibold d-block text-primary"><?= e($post['category']); ?></span>
                                <h3 class="h4 mt-2"><a
                                        href="<?= e(app_url('article.php?slug=' . urlencode($post['slug']))); ?>"
                                        class="text-inherit"><?= e($post['title']); ?></a></h3>
                                <p><?= e($post['excerpt']); ?></p>
                            </div>
                        </div>
                    </div><?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/includes/public_footer.php'; ?>