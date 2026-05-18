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
                        Le Collectif des Étudiants Congolais au Burundi œuvre pour
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

    <section class="py-8 bg-white border-top">
        <div class="container my-lg-4">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-5">
                            <div class="mb-4">
                                <i class="fe fe-target h1 text-primary"></i>
                            </div>
                            <h2 class="h3 fw-bold mb-3">Notre Mission</h2>
                            <p class="mb-0 text-muted">Offrir un cadre d'accueil structuré, de représentation et d'accompagnement académique et social pour chaque étudiant congolais vivant au Burundi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-5">
                            <div class="mb-4">
                                <i class="fe fe-eye h1 text-success"></i>
                            </div>
                            <h2 class="h3 fw-bold mb-3">Notre Vision</h2>
                            <p class="mb-0 text-muted">Devenir une communauté estudiantine d'excellence, actrice du changement et modèle d'intégration régionale au cœur de l'Afrique de l'Est.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-5">
                            <div class="mb-4">
                                <i class="fe fe-heart h1 text-danger"></i>
                            </div>
                            <h2 class="h3 fw-bold mb-3">Nos Valeurs</h2>
                            <p class="mb-0 text-muted"><strong>Unité, Intégrité, Solidarité.</strong> Ces trois piliers guident toutes nos actions au quotidien pour le bien-être de nos membres.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-8 align-items-center">
                <div class="col-lg-6">
                    <span class="text-uppercase text-primary fw-semibold ls-md">Nos Objectifs</span>
                    <h2 class="display-4 fw-bold mt-3 mb-4">Ce que nous réalisons ensemble</h2>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex">
                            <i class="fe fe-check-circle text-success me-2 mt-1"></i>
                            <span>Faciliter l’intégration des nouveaux étudiants arrivant au Burundi.</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fe fe-check-circle text-success me-2 mt-1"></i>
                            <span>Assurer une représentation officielle auprès des autorités académiques et consulaires.</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fe fe-check-circle text-success me-2 mt-1"></i>
                            <span>Organiser des événements culturels, sportifs et scientifiques.</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fe fe-check-circle text-success me-2 mt-1"></i>
                            <span>Soutenir l’excellence académique via l’entraide et le mentorat.</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 mt-6 mt-lg-0">
                    <img src="assets/images/about/about-2.jpg" alt="CECOB Community" class="img-fluid rounded-4 shadow">
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/includes/public_footer.php'; ?>