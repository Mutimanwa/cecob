<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'CECOB | Accueil';
$currentPage = 'home';
$posts = fetch_latest_posts();
$events = fetch_upcoming_events();

require_once __DIR__ . '/includes/public_header.php';
?>
<main>
  <section class="py-lg-3 py-6">
    <div class="container my-lg-8">
      <div class="row align-items-center">
        <!-- Hero text -->
        <div class="col-lg-6 col-12">
          <h1 class="display-2 fw-bold mt-3 mb-3">Construisons une communauté étudiante <u class="text-warning"><span
                class="text-primary">forte et solidaire</span></u> au Burundi.</h1>
          <p class="lead mb-4">CECOB accompagne les étudiants congolais à travers l’intégration, l’entraide académique, les activités culturelles, les événements communautaires et une gestion associative moderne entièrement digitalisée.</p>
          <div class="d-flex flex-wrap gap-3 mb-4">
            <a href="<?= e(app_url('membership.php')); ?>" class="btn btn-primary btn-lg">Faire une adhesion</a>
            <a href="<?= e(app_url('events.php')); ?>" class="btn btn-outline-dark btn-lg">Découvrir les événements</a>
          </div>
          <div class="row row-cols-2 row-cols-md-4 g-3">
            <div class="col">
              <div class="border rounded-3 p-3 h-100">
                <h3 class="mb-0"><?= count_table('members'); ?></h3><small class="text-muted">Membres</small>
              </div>
            </div>
            <div class="col">
              <div class="border rounded-3 p-3 h-100">
                <h3 class="mb-0"><?= count_table('adhesion_requests'); ?></h3><small class="text-muted">Demandes</small>
              </div>
            </div>
            <div class="col">
              <div class="border rounded-3 p-3 h-100">
                <h3 class="mb-0"><?= count_table('events'); ?></h3><small class="text-muted">Evenements</small>
              </div>
            </div>
            <div class="col">
              <div class="border rounded-3 p-3 h-100">
                <h3 class="mb-0"><?= count_table('partners'); ?></h3><small class="text-muted">Partenaires</small>
              </div>
            </div>
          </div>
        </div>
        <!-- Images -->
        <div class="col-xxl-5 offset-xxl-1 col-xl-6 col-lg-6 col-12 d-lg-flex justify-content-end">
          <div class="mt-8 mt-lg-0 position-relative">
            <div class="position-absolute top-0 start-0 translate-middle d-none d-md-block">
              <img src="<?= e(app_url('assets/images/svg/graphics-2.svg')); ?>" alt="graphics-2">
            </div>
            <img src="<?= e(app_url('assets/images/hero/hero.jpeg')); ?>" alt="online course"
              class="img-fluid rounded-4 w-100 z-1 position-relative">
            <div class="position-absolute top-100 start-100 translate-middle d-none d-md-block">
              <img src="<?= e(app_url('assets/images/svg/graphics-1.svg')); ?>" alt="graphics-1">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--trusted-->
  <div class="py-6">
    <div class="container text-center">
      <div class="row">
        <div class="col-xl-12 col-md-12 col-12">
          <div class="text-center mb-6">
            <span class="text-uppercase text-gray-400 ls-md fw-semibold">Trusted by over 12,500 great teams</span>
          </div>
        </div>
        <div class="col-xl-10 offset-xl-1">
          <div class="table-responsive-lg">
            <div class="row row-cols-lg-5 row-cols-md-3 row-cols-2 g-4 flex-nowrap">
              <div class="col">
                <div class="text-center mb-3">
                  <img src="assets/images/brand/gray-logo-airbnb.svg" alt="airbnb" class="img-fluid">
                </div>
              </div>
              <div class="col">
                <div class="text-center mb-3">
                  <img src="assets/images/brand/gray-logo-digitalocean.svg" alt="digitalocean" class="img-fluid">
                </div>
              </div>
              <div class="col">
                <div class="text-center mb-3">
                  <img src="assets/images/brand/gray-logo-discord.svg" alt="discord" class="img-fluid">
                </div>
              </div>
              <div class="col">
                <div class="text-center mb-3">
                  <img src="assets/images/brand/gray-logo-intercom.svg" alt="intercom" class="img-fluid">
                </div>
              </div>
              <div class="col">
                <div class="text-center mb-3">
                  <img src="assets/images/brand/gray-logo-netflix.svg" alt="netflix" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--trusted-->

  <section class="py-lg-8 py-6 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-md-12 col-12">
          <div class="mb-6 mb-lg-8">
            <h2 class="h1 fw-bold">
              Evenements
              <u class="text-warning"><span class="text-primary">à venir</span></u>
            </h2>
            <p class="mb-0 lead">Les evenements prevue par le centre dans les jour à venir.</p>
          </div>
        </div>
      </div>
      <div class="row g-4">
        <!-- la liste des evenements -->
        <?php foreach ($events as $event): ?>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card h-100">
              <img src="<?= e($event['image_path'] ?: 'assets/images/education/edu-webinar-1.jpg'); ?>"
                class="card-img-top" alt="<?= e($event['title']); ?>" />
              <div class="card-body">
                <span
                  class="badge bg-primary-subtle text-primary"><?= e(date('d M Y', strtotime($event['starts_at']))); ?></span>
                <h3 class="h4 mt-3"><?= e($event['title']); ?></h3>
                <p class="mb-2"><?= e($event['location']); ?></p>
                <p class="mb-0"><?= e($event['description']); ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="py-lg-8 py-6">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-md-12 col-12">
          <div class="mb-lg-8 mb-6">
            <h2 class="h1 fw-bold">
              Actualites et 
              <u class="text-warning"><span class="text-primary">Blog</span></u>
            </h2>
            <p class="lead mb-0">Publications recentes .</p>
          </div>
        </div>
      </div>
      <div class="row g-4">
        <?php foreach ($posts as $post): ?>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card h-100 card-hover">
              <img src="<?= e($post['image_path'] ?: 'assets/images/blog/blogpost-1.jpg'); ?>" class="card-img-top"
                alt="<?= e($post['title']); ?>" />
              <div class="card-body">
                <div class="mb-2">
                  <span class="text-primary fw-semibold small"><?= e($post['category']); ?></span>
                  <h3 class="h4 mt-2"><a href="<?= e(app_url('article.php?slug=' . urlencode($post['slug']))); ?>"
                      class="text-inherit"><?= e($post['title']); ?></a></h3>
                  <p class="mb-0"><?= e($post['excerpt']); ?></p>

                </div>
                <a href="<?= e(app_url('article.php?slug=' . urlencode($post['slug']))); ?>"
                  class="btn btn-light-primary text-primary">Voir plus</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!--find right-->
<section class="pb-lg-8">
  <div class="container">
    <div class="row">
      <div class="col-xl-10 offset-xl-1 col-md-12 col-12">
        <div class="bg-primary py-6 px-6 px-xl-0 rounded-4">
          <div class="row align-items-center">
            <div class="offset-xl-1 col-xl-5 col-md-6 col-12">
              <div>
                <h2 class="h1 text-white mb-3">
                  Rejoignez la communauté des étudiants congolais au Burundi
                </h2>

                <p class="text-white-50 fs-4">
                  CECOB rassemble les étudiants congolais autour de l’entraide,
                  de l’intégration, du développement académique et des activités
                  culturelles pour construire une communauté forte et solidaire.
                </p>

                <button class="btn btn-dark">
                  Faire une adhésion
                </button>
              </div>
            </div>

            <div class="col-xl-6 col-md-6 col-12">
              <div class="text-center d-none d-md-block">
                <img src="assets/images/education/course.png" alt="CECOB members" class="img-fluid">
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <!--find right-->
</main>
<?php require_once __DIR__ . '/includes/public_footer.php'; ?>