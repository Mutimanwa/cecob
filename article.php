<?php
require_once __DIR__ . '/includes/bootstrap.php';
$slug = trim($_GET['slug'] ?? '');
$post = $slug !== '' ? fetch_post_by_slug($slug) : null;

if (!$post) {
    set_flash('warning', 'Article introuvable.');
    redirect_to('blog.php');
}

$pageTitle = 'CECOB | Publication';
$currentPage = 'blog';
require_once __DIR__ . '/includes/public_header.php';
?>
<main>
    <section class="py-8 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 text-center"><span
                        class="badge bg-success-subtle text-success"><?= e($post['category']); ?></span>
                    <h1 class="display-4 fw-bold mt-3"><?= e($post['title']); ?></h1>
                    <p class="lead"><?= e($post['excerpt']); ?></p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-8">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8"><img src="<?= e($post['image_path'] ?: 'assets/images/blog/center-img.jpg'); ?>"
                        class="img-fluid rounded-4 mb-5" alt="" />
                    <p><?= nl2br(e($post['body'])); ?></p>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/includes/public_footer.php'; ?>