<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$id = (int) ($_GET['id'] ?? 0);
$event = null;
if ($id) {
  $stmt = db()->prepare('SELECT * FROM events WHERE id = ?');
  $stmt->execute([$id]);
  $event = fetch_one_assoc($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  verify_csrf();

  $title = $_POST['title'] ?? '';
  $description = $_POST['description'] ?? '';
  $starts_at = $_POST['starts_at'] ?? '';
  $location = $_POST['location'] ?? '';
  $capacity = (int) ($_POST['capacity'] ?? 0);
  $imagePath = $event['image_path'] ?? null;

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploaded = upload_file($_FILES['image'], 'assets/images/events');
    if ($uploaded) {
      $imagePath = $uploaded;
    }
  }

  $data = [
    'title' => $title,
    'description' => $description,
    'starts_at' => $starts_at,
    'location' => $location,
    'capacity' => $capacity,
    'image_path' => $imagePath
  ];

  if ($id) {
    $data['id'] = $id;
  }

  if (save_event($data)) {
    set_flash('success', 'Evenement enregistre avec succes.');
    redirect_to('admin/events.php');
  } else {
    set_flash('danger', 'Une erreur est survenue lors de l\'enregistrement.');
  }
}

$pageTitle = $id ? 'CECOB | Modifier Evenement' : 'CECOB | Créer Evenement';
$adminPage = 'events';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<section class="container-fluid p-4">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-lg-row gap-3 align-items-lg-center justify-content-between">
        <div class="d-flex flex-column gap-1">
          <h1 class="mb-0 h2 fw-bold"><?= $id ? 'Modifier l\'Evenement' : 'Créer un Evenement'; ?></h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="events.php">Evenements</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $id ? 'Modifier' : 'Nouveau'; ?></li>
            </ol>
          </nav>
        </div>
        <div>
          <a href="events.php" class="btn btn-outline-secondary">Retour aux evenements</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="offset-xl-3 col-xl-6 col-md-12 col-12">
      <div class="card">
        <div class="card-body p-lg-6">
          <form action="" method="POST" enctype="multipart/form-data" class="row gx-3">
            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">

            <div class="mb-3 col-12">
              <label class="form-label">Titre <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control" value="<?= e($event['title'] ?? ''); ?>" placeholder="Titre de l'evenement" required>
            </div>

            <div class="mb-3 col-12">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3"><?= e($event['description'] ?? ''); ?></textarea>
            </div>

            <div class="mb-3 col-md-6 col-12">
              <label class="form-label">Date et Heure <span class="text-danger">*</span></label>
              <div class="input-group">
                <input class="form-control flatpickr" type="text" name="starts_at" value="<?= e($event['starts_at'] ?? ''); ?>" placeholder="Selectionnez" required>
                <span class="input-group-text"><i class="fe fe-calendar"></i></span>
              </div>
            </div>

            <div class="mb-3 col-md-6 col-12">
              <label class="form-label">Lieu <span class="text-danger">*</span></label>
              <input type="text" name="location" class="form-control" value="<?= e($event['location'] ?? ''); ?>" placeholder="Ex: Salle A, Bujumbura" required>
            </div>

            <div class="mb-3 col-md-6 col-12">
              <label class="form-label">Capacite (0 pour illimite)</label>
              <input type="number" name="capacity" class="form-control" value="<?= e($event['capacity'] ?? 0); ?>">
            </div>

            <div class="col-12 mb-4">
              <label class="form-label">Image de couverture</label>
              <?php if ($event && $event['image_path']): ?>
                <div class="mb-2">
                  <img src="<?= e(app_url($event['image_path'])); ?>" alt="" class="img-fluid rounded" style="max-height: 150px;">
                </div>
              <?php endif; ?>
              <input class="form-control" type="file" name="image">
            </div>

            <div class="col-12">
              <button class="btn btn-primary" type="submit"><?= $id ? 'Mettre à jour' : 'Créer'; ?></button>
              <a href="events.php" class="btn btn-outline-secondary ms-2">Annuler</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Flatpickr Integration -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr(".flatpickr", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
  });
</script>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>