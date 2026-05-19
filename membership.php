<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CECOB | Adhesion';
$currentPage = 'membership';
require_once __DIR__ . '/includes/public_header.php';
?>
<main>
  <section class="py-8 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <span class="text-uppercase text-primary fw-semibold ls-md">Adhésion CECOB</span>
          <h1 class="display-4 fw-bold mt-3">Devenir Membre du Collectif</h1>
          <p class="lead mb-0">Rejoignez une communauté solidaire d'étudiants congolais au Burundi. Votre engagement commence ici.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-8">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div id="stepperForm" class="bs-stepper">
            <div class="bs-stepper-header mb-5" role="tablist">
              <div class="step" data-target="#step-identity">
                <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger1" aria-controls="step-identity">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label d-none d-md-inline-block">Identité</span>
                </button>
              </div>
              <div class="bs-stepper-line"></div>
              <div class="step" data-target="#step-academic">
                <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger2" aria-controls="step-academic">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label d-none d-md-inline-block">Études</span>
                </button>
              </div>
              <div class="bs-stepper-line"></div>
              <div class="step" data-target="#step-contact">
                <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3" aria-controls="step-contact">
                  <span class="bs-stepper-circle">3</span>
                  <span class="bs-stepper-label d-none d-md-inline-block">Compte</span>
                </button>
              </div>
              <div class="bs-stepper-line"></div>
              <div class="step" data-target="#step-finish">
                <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger4" aria-controls="step-finish">
                  <span class="bs-stepper-circle">4</span>
                  <span class="bs-stepper-label d-none d-md-inline-block">Finalisation</span>
                </button>
              </div>
            </div>

            <div class="bs-stepper-content">
              <form method="post" action="<?= e(app_url('public_handlers/membership_submit.php')); ?>" onSubmit="return validateForm()">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()); ?>" />

                <!-- Step 1 -->
                <div id="step-identity" class="content role-tabpanel" aria-labelledby="stepperFormTrigger1">
                  <div class="row g-3">
                    <div class="col-md-12 mb-3">
                      <h3>Informations Personnelles</h3>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Nom complet <span class="text-danger">*</span></label>
                      <input class="form-control" name="full_name" value="<?= e(old('full_name')); ?>" placeholder="Prénom et Nom" required />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Genre <span class="text-danger">*</span></label>
                      <select class="form-select" name="gender" required>
                        <option value="">Sélectionner</option>
                        <option <?= old('gender') === 'Masculin' ? 'selected' : ''; ?>>Masculin</option>
                        <option <?= old('gender') === 'Féminin' ? 'selected' : ''; ?>>Féminin</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Date de naissance <span class="text-danger">*</span></label>
                      <input class="form-control flatpickr" type="date" name="birth_date" value="<?= e(old('birth_date')); ?>" required />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Nationalité <span class="text-danger">*</span></label>
                      <input class="form-control" name="nationality" value="<?= e(old('nationality', 'Congolaise')); ?>" required />
                    </div>
                    <div class="col-12 mt-4 text-end">
                      <button type="button" class="btn btn-primary" onclick="stepperForm.next()">Continuer <i class="fe fe-arrow-right ms-1"></i></button>
                    </div>
                  </div>
                </div>

                <!-- Step 2 -->
                <div id="step-academic" class="content role-tabpanel" aria-labelledby="stepperFormTrigger2">
                  <div class="row g-3">
                    <div class="col-md-12 mb-3">
                      <h3>Détails Académiques</h3>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Université <span class="text-danger">*</span></label>
                      <input class="form-control" name="university" value="<?= e(old('university')); ?>" placeholder="Ex: Université du Burundi" required />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Niveau académique <span class="text-danger">*</span></label>
                      <select class="form-select" name="academic_level" required>
                        <option value="">Sélectionner</option>
                        <option <?= old('academic_level') === 'Bac 1' ? 'selected' : ''; ?>>Bac 1</option>
                        <option <?= old('academic_level') === 'Bac 2' ? 'selected' : ''; ?>>Bac 2</option>
                        <option <?= old('academic_level') === 'Bac 3' ? 'selected' : ''; ?>>Bac 3</option>
                        <option <?= old('academic_level') === 'Master' ? 'selected' : ''; ?>>Master</option>
                        <option <?= old('academic_level') === 'Doct' ? 'selected' : ''; ?>>Doctorat</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Faculté / Institut <span class="text-danger">*</span></label>
                      <input class="form-control" name="faculty" value="<?= e(old('faculty')); ?>" required />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Département <span class="text-danger">*</span></label>
                      <input class="form-control" name="department" value="<?= e(old('department')); ?>" required />
                    </div>
                    <div class="col-md-12 mb-3">
                      <label class="form-label">Numéro étudiant (Carte) <span class="text-danger">*</span></label>
                      <input class="form-control" name="student_id" value="<?= e(old('student_id')); ?>" required />
                    </div>
                    <div class="col-12 mt-4 d-flex justify-content-between">
                      <button type="button" class="btn btn-outline-secondary" onclick="stepperForm.previous()"><i class="fe fe-arrow-left me-1"></i> Précédent</button>
                      <button type="button" class="btn btn-primary" onclick="stepperForm.next()">Continuer <i class="fe fe-arrow-right ms-1"></i></button>
                    </div>
                  </div>
                </div>

                <!-- Step 3 -->
                <div id="step-contact" class="content role-tabpanel" aria-labelledby="stepperFormTrigger3">
                  <div class="row g-3">
                    <div class="col-md-12 mb-3">
                      <h3>Compte & Contact</h3>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Email <span class="text-danger">*</span></label>
                      <input class="form-control" type="email" name="email" value="<?= e(old('email')); ?>" placeholder="exemple@mail.com" required />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                      <input class="form-control" name="phone" value="<?= e(old('phone')); ?>" placeholder="+257 ..." required />
                    </div>
                    <div class="col-md-12 mb-3">
                      <label class="form-label">Créer un mot de passe <span class="text-danger">*</span></label>
                      <input class="form-control" type="password" name="password" placeholder="Min. 8 caractères" required />
                      <small class="text-muted">Il servira pour vous connecter après validation.</small>
                    </div>
                    <div class="col-12 mt-4 d-flex justify-content-between">
                      <button type="button" class="btn btn-outline-secondary" onclick="stepperForm.previous()"><i class="fe fe-arrow-left me-1"></i> Précédent</button>
                      <button type="button" class="btn btn-primary" onclick="stepperForm.next()">Continuer <i class="fe fe-arrow-right ms-1"></i></button>
                    </div>
                  </div>
                </div>

                <!-- Step 4 -->
                <div id="step-finish" class="content role-tabpanel" aria-labelledby="stepperFormTrigger4">
                  <div class="row g-3">
                    <div class="col-md-12 mb-3">
                      <h3>Finalisation</h3>
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label">Pièces justificatives ou remarques</label>
                      <textarea class="form-control" name="supporting_documents" rows="4" placeholder="Mentionnez ici toute information complémentaire ou lien vers vos documents numérisés (Google Drive, etc.) si applicable."><?= e(old('supporting_documents')); ?></textarea>
                    </div>
                    <div class="col-12 mb-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agreeCheck" required>
                        <label class="form-check-label" for="agreeCheck">
                          Je confirme l'exactitude des informations fournies et accepte les statuts du CECOB.
                        </label>
                      </div>
                    </div>
                    <div class="col-12 mt-4 d-flex justify-content-between">
                      <button type="button" class="btn btn-outline-secondary" onclick="stepperForm.previous()"><i class="fe fe-arrow-left me-1"></i> Précédent</button>
                      <button type="submit" class="btn btn-success">Soumettre ma demande</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php clear_old_input();
require_once __DIR__ . '/includes/public_footer.php'; 
?>