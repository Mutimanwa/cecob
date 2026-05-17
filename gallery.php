<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CECOB | Galerie';
$currentPage = 'gallery';
require_once __DIR__ . '/includes/public_header.php';
?>
<main>
    <section class="py-8 ">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Galerie institutionnelle</h1>
            <p class="lead mb-0">Base visuelle prete pour un futur branchement media en base.</p>
        </div>
    </section>
    <section class="py-8">
        <div class="container">
                    <!-- gallery -->
        <div class="gallery mb-8">

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--1 mb-0">
                <img src="assets/images/about/about.jpg"
                    alt="Activités CECOB"
                    class="gallery__img rounded-3">
            </figure>

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--2 mb-0">
                <img src="assets/images/about/about-2.jpg"
                    alt="Étudiants CECOB"
                    class="gallery__img rounded-3">
            </figure>

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--3 mb-0">
                <img src="assets/images/about/about-3.jpg"
                    alt="Communauté étudiante"
                    class="gallery__img rounded-3">
            </figure>

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--4 mb-0">
                <img src="assets/images/about/about.jpg"
                    alt="Événements étudiants"
                    class="gallery__img rounded-3">
            </figure>

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--5 mb-0">
                <img src="assets/images/about/about-2.jpg"
                    alt="Leadership étudiant"
                    class="gallery__img rounded-3">
            </figure>

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--6 mb-0">
                <img src="assets/images/about/about-3.jpg"
                    alt="Association CECOB"
                    class="gallery__img rounded-3">
            </figure>

        </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/includes/public_footer.php'; ?>