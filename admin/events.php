<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
  $id = (int) ($_GET['id'] ?? 0);
  if (delete_record('events', $id)) {
    set_flash('success', 'Événement supprimé avec succès.');
  } else {
    set_flash('danger', 'Erreur lors de la suppression.');
  }
  redirect_to('admin/events.php');
}

$pageTitle = 'CECOB | Événements';
$adminPage = 'events';
$events = fetch_all_assoc(db()->query('SELECT * FROM events ORDER BY starts_at DESC'));

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <div class="border-bottom pb-3 mb-3 d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column gap-1">
          <h1 class="mb-0 h2 fw-bold">Gestion des Événements</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Événements</li>
            </ol>
          </nav>
        </div>
        <div>
          <a href="event-add.php" class="btn btn-primary">Nouvel Événement</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <div class="card rounded-3">
        <div class="table-responsive">
          <table class="table mb-0 text-nowrap table-centered table-hover">
            <thead class="table-light">
              <tr>
                <th>Événement</th>
                <th>Lieu</th>
                <th>Date et Heure</th>
                <th>Capacité</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($events)): ?>
                <tr>
                  <td colspan="5" class="text-center p-4">Aucun événement trouvé.</td>
                </tr>
              <?php endif; ?>
              <?php foreach ($events as $e): ?>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="<?= e(app_url($e['image_path'] ?? 'assets/images/placeholder.jpg')); ?>" alt="" class="rounded img-4by3-lg" style="width: 100px; height: 75px; object-fit: cover;" />
                      <div class="ms-3">
                        <h5 class="mb-0">
                          <a href="event-add.php?id=<?= $e['id']; ?>" class="text-inherit"><?= e($e['title']); ?></a>
                        </h5>
                      </div>
                    </div>
                  </td>
                  <td><?= e($e['location']); ?></td>
                  <td><?= date('d M, Y H:i', strtotime($e['starts_at'])); ?></td>
                  <td><?= (int)$e['capacity'] > 0 ? (int)$e['capacity'] : 'Illimitée'; ?></td>
                  <td>
                    <span class="dropdown dropstart">
                      <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fe fe-more-vertical"></i>
                      </a>
                      <span class="dropdown-menu">
                        <a class="dropdown-item" href="event-add.php?id=<?= $e['id']; ?>">
                          <i class="fe fe-edit dropdown-item-icon"></i> Modifier
                        </a>
                        <a class="dropdown-item text-danger" href="?action=delete&id=<?= $e['id']; ?>" onclick="return confirm('Supprimer cet événement ?')">
                          <i class="fe fe-trash dropdown-item-icon"></i> Supprimer
                        </a>
                      </span>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>