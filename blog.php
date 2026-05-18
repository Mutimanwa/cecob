<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CECOB | Blog & Actualités';
$currentPage = 'blog';

// Filter by category
$activeCategory = $_GET['category'] ?? null;
$posts = fetch_posts_page($activeCategory);

// Fetch categories for tabs
$allCategories = fetch_all_assoc(db()->query("SELECT DISTINCT category FROM posts WHERE status = 'published'"));

require_once __DIR__ . '/includes/public_header.php';
?>
<main>
    <section class="py-8 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10 col-12 text-center">
                    <span class="text-uppercase text-primary fw-semibold ls-md">Actualités & Vie Associative</span>
                    <h1 class="display-4 fw-bold mt-3">Restez informé de l'actualité du CECOB</h1>
                    <p class="lead">Découvrez les derniers communiqués, événements et récits de notre communauté estudiantine au Burundi.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-6">
        <div class="container">
            <!-- Category Tabs -->
            <ul class="nav nav-line-bottom mb-6 justify-content-center">
                <li class="nav-item">
                    <a class="nav-link <?= !$activeCategory ? 'active' : ''; ?>" href="blog.php">Tous les articles</a>
                </li>
                <?php foreach ($allCategories as $cat): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $activeCategory === $cat['category'] ? 'active' : ''; ?>"
                            href="blog.php?category=<?= urlencode($cat['category']); ?>">
                            <?= e($cat['category']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="row g-4">
                <?php if (empty($posts)): ?>
                    <div class="col-12 text-center py-5">
                        <i class="fe fe-layers display-4 text-muted mb-3 d-block"></i>
                        <p class="lead">Aucun article trouvé dans cette catégorie.</p>
                        <a href="blog.php" class="btn btn-outline-primary">Voir tous les articles</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm card-hover">
                                <a href="<?= e(app_url('article.php?slug=' . urlencode($post['slug']))); ?>">
                                    <img src="<?= e($post['image_path'] ?: 'uploads/blog/blogpost-1.jpg'); ?>"
                                        class="card-img-top" alt="<?= e($post['title']); ?>" style="height: 200px; object-fit: cover;" />
                                </a>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <span class="badge bg-primary-soft text-primary"><?= e($post['category']); ?></span>
                                        <span class="ms-2 small text-muted"><?= date('d M, Y', strtotime($post['published_at'])); ?></span>
                                    </div>
                                    <h3 class="h4 mt-2">
                                        <a href="<?= e(app_url('article.php?slug=' . urlencode($post['slug']))); ?>" class="text-inherit text-decoration-none">
                                            <?= e($post['title']); ?>
                                        </a>
                                    </h3>
                                    <p class="text-muted mb-0"><?= e($post['excerpt']); ?></p>
                                </div>
                                <div class="card-footer bg-white border-top-0 pb-4">
                                    <a href="<?= e(app_url('article.php?slug=' . urlencode($post['slug']))); ?>" class="btn-link fw-semibold">
                                        Lire la suite <i class="fe fe-arrow-right ms-1"></i>
                                    </a>
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