<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

// Handle simple actions
if (isset($_GET['action'])) {
  $id = (int) ($_GET['id'] ?? 0);
  if ($_GET['action'] === 'delete') {
    if (delete_record('posts', $id)) {
      set_flash('success', 'Article supprime avec succes.');
    } else {
      set_flash('danger', 'Erreur lors de la suppression.');
    }
  } elseif ($_GET['action'] === 'toggle') {
    $status = $_GET['status'] === 'published' ? 'published' : 'draft';
    $stmt = db()->prepare('UPDATE posts SET status = ? WHERE id = ?');
    $stmt->execute([$status, $id]);
    set_flash('success', 'Statut mis a jour.');
  }
  redirect_to('admin/posts.php');
}

$pageTitle = 'CECOB | Blog';
$adminPage = 'posts';
$posts = fetch_all_assoc(db()->query('SELECT p.* FROM posts p ORDER BY p.published_at DESC'));

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <div class="border-bottom pb-3 mb-3 d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column gap-1">
          <h1 class="mb-0 h2 fw-bold">Gestion du Blog</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Articles</li>
            </ol>
          </nav>
        </div>
        <div>
          <a href="post-add.php" class="btn btn-primary">Nouvel Article</a>
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
                <th>Article</th>
                <th>Categorie</th>
                <th>Date de publication</th>
                <th>Statut</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($posts)): ?>
                <tr>
                  <td colspan="5" class="text-center p-4">Aucun article trouvé.</td>
                </tr>
              <?php endif; ?>
              <?php foreach ($posts as $p): ?>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="<?= e(app_url($p['image_path'] ?? 'uploads/blog/blogpost-1.jpg')); ?>" alt="" class="rounded img-4by3-lg" style="width: 100px; height: 75px; object-fit: cover;" />
                      <div class="ms-3">
                        <h5 class="mb-0">
                          <a href="post-add.php?id=<?= $p['id']; ?>" class="text-inherit"><?= e($p['title']); ?></a>
                        </h5>
                        <small class="text-muted"><?= e($p['slug']); ?></small>
                      </div>
                    </div>
                  </td>
                  <td><?= e($p['category']); ?></td>
                  <td><?= date('d M, Y H:i', strtotime($p['published_at'])); ?></td>
                  <td>
                    <span class="badge-dot bg-<?= $p['status'] === 'published' ? 'success' : 'warning'; ?> me-1 d-inline-block align-middle"></span>
                    <?= ucfirst($p['status']); ?>
                  </td>
                  <td>
                    <span class="dropdown dropstart">
                      <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fe fe-more-vertical"></i>
                      </a>
                      <span class="dropdown-menu">
                        <a class="dropdown-item" href="post-add.php?id=<?= $p['id']; ?>">
                          <i class="fe fe-edit dropdown-item-icon"></i> Modifier
                        </a>
                        <a class="dropdown-item" href="?action=toggle&id=<?= $p['id']; ?>&status=<?= $p['status'] === 'published' ? 'draft' : 'published'; ?>">
                          <i class="fe fe-<?= $p['status'] === 'published' ? 'toggle-left' : 'toggle-right'; ?> dropdown-item-icon"></i>
                          <?= $p['status'] === 'published' ? 'Passer en brouillon' : 'Publier'; ?>
                        </a>
                        <a class="dropdown-item text-danger" href="?action=delete&id=<?= $p['id']; ?>" onclick="return confirm('Supprimer cet article ?')">
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