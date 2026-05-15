<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CECOB | Contact';
$currentPage = 'contact';
require_once __DIR__ . '/includes/public_header.php';
?>
<main>
  <section class="container-fluid">
    <div class="row min-vh-100">
      <div class="offset-xl-1 col-xl-5 col-lg-6 col-12">
        <div class="py-8 me-xl-8 pe-xl-8">
          <h1 class="display-4 fw-bold">Entrer en contact avec CECOB.</h1>
          <p class="lead text-dark">Le secretariat et l’equipe communication recoivent vos demandes depuis ce formulaire.</p>
        </div>
      </div>
      <div class="col-lg-6 d-lg-flex align-items-center bg-light">
        <div class="px-4 px-xl-8 mx-xl-8 py-8 py-lg-0 w-100">
          <form class="row" method="post" action="<?= e(app_url('public_handlers/contact_submit.php')); ?>">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()); ?>" />
            <div class="mb-3 col-12 col-md-6"><label class="form-label">Nom complet</label><input class="form-control" type="text" name="name" value="<?= e(old('name')); ?>" required /></div>
            <div class="mb-3 col-12 col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="<?= e(old('email')); ?>" required /></div>
            <div class="mb-3 col-12 col-md-6"><label class="form-label">Telephone</label><input class="form-control" type="text" name="phone" value="<?= e(old('phone')); ?>" required /></div>
            <div class="mb-3 col-12 col-md-6"><label class="form-label">Objet</label><select class="form-select" name="subject" required><option value="">Selectionner</option><option <?= old('subject') === 'Demande d’adhesion' ? 'selected' : ''; ?>>Demande d’adhesion</option><option <?= old('subject') === 'Evenement' ? 'selected' : ''; ?>>Evenement</option><option <?= old('subject') === 'Partenariat' ? 'selected' : ''; ?>>Partenariat</option><option <?= old('subject') === 'Support administratif' ? 'selected' : ''; ?>>Support administratif</option></select></div>
            <div class="mb-3 col-12"><label class="form-label">Message</label><textarea class="form-control" name="message" rows="5" required><?= e(old('message')); ?></textarea></div>
            <div class="col-12"><button class="btn btn-primary" type="submit">Envoyer</button></div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
<?php clear_old_input(); require_once __DIR__ . '/includes/public_footer.php'; ?>

