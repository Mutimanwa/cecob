<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CECOB | A propos';
$currentPage = 'about';
require_once __DIR__ . '/includes/public_header.php';
?>
<main>
<section class="py-8 bg-white">
    <div class="container my-lg-4">

        <div class="row">
            <div class="offset-lg-2 col-lg-8 col-md-12 col-12 mb-8">

                <!-- caption-->
                <h1 class="display-2 fw-bold mb-3">
                    Bienvenue à
                    <span class="text-primary">CECOB</span>
                </h1>

                <!-- para -->
                <p class="h2 mb-3">
                    L’Association des Étudiants Congolais au Burundi œuvre pour
                    l’unité, l’intégration et l’accompagnement des étudiants
                    congolais dans leur parcours académique et social.
                </p>

                <p class="mb-0 h4 text-body lh-lg">
                    CECOB construit une communauté étudiante dynamique basée sur
                    la solidarité, la représentation des étudiants, le développement
                    personnel, les activités culturelles, le leadership et
                    l’innovation. Notre mission est de créer un environnement
                    favorable à l’épanouissement des étudiants congolais vivant
                    au Burundi.
                </p>

            </div>
        </div>

        <!-- gallery -->
        <div class="gallery mb-8">

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--1 mb-0">
                <img src="assets/images/about/geeksui-img-1.jpg"
                    alt="Activités CECOB"
                    class="gallery__img rounded-3">
            </figure>

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--2 mb-0">
                <img src="assets/images/about/geeksui-img-2.jpg"
                    alt="Étudiants CECOB"
                    class="gallery__img rounded-3">
            </figure>

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--3 mb-0">
                <img src="assets/images/about/geeksui-img-3.jpg"
                    alt="Communauté étudiante"
                    class="gallery__img rounded-3">
            </figure>

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--4 mb-0">
                <img src="assets/images/about/geeksui-img-4.jpg"
                    alt="Événements étudiants"
                    class="gallery__img rounded-3">
            </figure>

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--5 mb-0">
                <img src="assets/images/about/geeksui-img-5.jpg"
                    alt="Leadership étudiant"
                    class="gallery__img rounded-3">
            </figure>

            <!-- gallery-item -->
            <figure class="gallery__item gallery__item--6 mb-0">
                <img src="assets/images/about/geeksui-img-6.jpg"
                    alt="Association CECOB"
                    class="gallery__img rounded-3">
            </figure>

        </div>

        <div class="row">

            <!-- row -->
            <div class="col-md-6 offset-right-md-6">

                <!-- heading -->
                <h1 class="display-4 fw-bold mb-3">
                    Une communauté étudiante en pleine croissance
                </h1>

                <!-- para -->
                <p class="lead">
                    CECOB rassemble les étudiants congolais présents dans plusieurs
                    universités du Burundi afin de promouvoir l’entraide,
                    l’excellence académique et le développement communautaire.
                </p>

            </div>

            <!-- counter -->
            <div class="col-lg-3 col-md-6 col-6">
                <div class="border-top pt-4 mt-6 mb-5">
                    <h1 class="display-3 fw-bold mb-0">
                        <?= count_table('members'); ?>
                    </h1>
                    <p class="text-uppercase">
                        Membres actifs
                    </p>
                </div>
            </div>

            <!-- counter -->
            <div class="col-lg-3 col-md-6 col-6">
                <div class="border-top pt-4 mt-6 mb-5">
                    <h1 class="display-3 fw-bold mb-0">
                        <?= count_table('events'); ?>
                    </h1>
                    <p class="text-uppercase">
                        Événements organisés
                    </p>
                </div>
            </div>

            <!-- counter -->
            <div class="col-lg-3 col-md-6 col-6">
                <div class="border-top pt-4 mt-6 mb-5">
                    <h1 class="display-3 fw-bold mb-0">
                        <?= count_table('partners'); ?>
                    </h1>
                    <p class="text-uppercase">
                        Partenaires
                    </p>
                </div>
            </div>

            <!-- counter -->
            <div class="col-lg-3 col-md-6 col-6">
                <div class="border-top pt-4 mt-6 mb-5">
                    <h1 class="display-3 fw-bold mb-0">
                        <?= count_table('posts'); ?>
                    </h1>
                    <p class="text-uppercase">
                        Publications
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

    <section class="py-8 bg-white">
        <div class="container my-lg-4">
            <div class="row">
                <div class="col-lg-8 col-12 mb-8">
                    <span class="text-uppercase text-primary fw-semibold ls-md">Identite
                        institutionnelle</span>
                    <h1 class="display-3 fw-bold mt-3 mb-3">CECOB porte la voix, la solidarite et l’organisation des
                        etudiants congolais au Burundi.</h1>
                    <p class="h3 mb-3">L’association structure l’accueil, la representation et l’accompagnement des
                        etudiants autour d’une gouvernance claire et d’outils modernes.</p>
                    <p class="mb-0 h5 text-body lh-lg">Le site et l’administration centralisent l’histoire, la mission,
                        les objectifs, les documents officiels et la structure dirigeante.</p>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/includes/public_footer.php'; ?>