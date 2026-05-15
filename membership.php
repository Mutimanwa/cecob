<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CECOB | Adhesion';
$currentPage = 'membership';
require_once __DIR__ . '/includes/public_header.php';
?>
<main>
  <section class="py-8 bg-light"><div class="container"><div class="row justify-content-center"><div class="col-lg-8 text-center"><span class="text-uppercase text-primary fw-semibold ls-md">Adhesion en ligne</span><h1 class="display-4 fw-bold mt-3">Soumettre une demande membre CECOB</h1><p class="lead mb-0">Le formulaire est maintenant relie au backend PHP procédural et a MySQL.</p></div></div></div></section>
  <section class="py-8"><div class="container"><div class="row justify-content-center"><div class="col-lg-10"><div class="card"><div class="card-body p-4 p-lg-5">
    <form class="row g-4" method="post" action="<?= e(app_url('public_handlers/membership_submit.php')); ?>">
      <input type="hidden" name="csrf_token" value="<?= e(csrf_token()); ?>" />
      <div class="col-md-6"><label class="form-label">Nom complet</label><input class="form-control" name="full_name" value="<?= e(old('full_name')); ?>" required /></div>
      <div class="col-md-6"><label class="form-label">Genre</label><select class="form-select" name="gender" required><option value="">Selectionner</option><option <?= old('gender') === 'Masculin' ? 'selected' : ''; ?>>Masculin</option><option <?= old('gender') === 'Feminin' ? 'selected' : ''; ?>>Feminin</option></select></div>
      <div class="col-md-6"><label class="form-label">Date de naissance</label><input class="form-control" type="date" name="birth_date" value="<?= e(old('birth_date')); ?>" required /></div>
      <div class="col-md-6"><label class="form-label">Nationalite</label><input class="form-control" name="nationality" value="<?= e(old('nationality', 'Congolaise')); ?>" required /></div>
      <div class="col-md-6"><label class="form-label">Universite</label><input class="form-control" name="university" value="<?= e(old('university')); ?>" required /></div>
      <div class="col-md-3"><label class="form-label">Faculte</label><input class="form-control" name="faculty" value="<?= e(old('faculty')); ?>" required /></div>
      <div class="col-md-3"><label class="form-label">Departement</label><input class="form-control" name="department" value="<?= e(old('department')); ?>" required /></div>
      <div class="col-md-6"><label class="form-label">Niveau academique</label><input class="form-control" name="academic_level" value="<?= e(old('academic_level')); ?>" required /></div>
      <div class="col-md-6"><label class="form-label">Numero etudiant</label><input class="form-control" name="student_id" value="<?= e(old('student_id')); ?>" required /></div>
      <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="<?= e(old('email')); ?>" required /></div>
      <div class="col-md-6"><label class="form-label">Telephone</label><input class="form-control" name="phone" value="<?= e(old('phone')); ?>" required /></div>
      <div class="col-md-6"><label class="form-label">Mot de passe</label><input class="form-control" type="password" name="password" required /></div>
      <div class="col-12"><label class="form-label">Pieces justificatives</label><textarea class="form-control" name="supporting_documents" rows="4"><?= e(old('supporting_documents')); ?></textarea></div>
      <div class="col-12 d-flex flex-wrap gap-3"><button class="btn btn-primary">Soumettre la demande</button><a href="<?= e(app_url('admin/membership-requests.php')); ?>" class="btn btn-outline-dark">Voir la validation admin</a></div>
    </form>
  </div></div></div></div></div></section>
</main>
<?php clear_old_input(); require_once __DIR__ . '/includes/public_footer.php'; ?>

