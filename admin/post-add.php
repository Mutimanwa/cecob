<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$id = (int) ($_GET['id'] ?? 0);
$post = null;
if ($id) {
  $stmt = db()->prepare('SELECT * FROM posts WHERE id = ?');
  $stmt->execute([$id]);
  $post = fetch_one_assoc($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  verify_csrf();

  $title = $_POST['title'] ?? '';
  $slug = $_POST['slug'] ?: slugify($title);
  $excerpt = $_POST['excerpt'] ?? '';
  $category = $_POST['category'] ?? '';
  $body = $_POST['body'] ?? '';
  $status = $_POST['status'] ?? 'draft';
  $imagePath = $post['image_path'] ?? null;

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploaded = upload_file($_FILES['image'], 'assets/images/blog');
    if ($uploaded) {
      $imagePath = $uploaded;
    }
  }

  $data = [
    'title' => $title,
    'slug' => $slug,
    'category' => $category,
    'excerpt' => $excerpt,
    'body' => $body,
    'image_path' => $imagePath,
    'status' => $status
  ];

  if ($id) {
    $data['id'] = $id;
  }

  if (save_post($data)) {
    set_flash('success', 'Article enregistre avec succes.');
    redirect_to('admin/posts.php');
  } else {
    set_flash('danger', 'Une erreur est survenue lors de l\'enregistrement.');
  }
}

$pageTitle = $id ? 'CECOB | Modifier Article' : 'CECOB | Ajouter Article';
$adminPage = 'posts';
require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
        <div class="d-flex flex-column gap-1">
          <h1 class="mb-0 h2 fw-bold"><?= $id ? 'Modifier l\'Article' : 'Ajouter un Article'; ?></h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="posts.php">Articles</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $id ? 'Modifier' : 'Nouveau'; ?></li>
            </ol>
          </nav>
        </div>
        <div>
          <a href="posts.php" class="btn btn-outline-secondary">Retour aux articles</a>
        </div>
      </div>
    </div>
  </div>
  <form action="" method="POST" enctype="multipart/form-data" id="postForm">
    <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
    <input type="hidden" name="body" id="postBodyInput">
    <input type="hidden" name="status" id="postStatusInput" value="<?= e($post['status'] ?? 'draft'); ?>">
    <div class="row gy-4">
      <div class="col-xl-9 col-lg-8 col-md-12 col-12">
        <div class="card border-0">
          <div class="card-header">
            <h4 class="mb-0">Contenu de l'article</h4>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">Image de couverture</label>
              <?php if ($post && $post['image_path']): ?>
                <div class="mb-2">
                  <img src="<?= e(app_url($post['image_path'])); ?>" alt="" class="img-fluid rounded" style="max-height: 200px;">
                </div>
              <?php endif; ?>
              <input type="file" name="image" class="form-control">
            </div>
            <div class="row">
              <div class="mb-3 col-md-9">
                <label for="postTitle" class="form-label">Titre</label>
                <input type="text" name="title" id="postTitle" class="form-control" value="<?= e($post['title'] ?? ''); ?>" required />
              </div>
              <div class="mb-3 col-md-9">
                <label for="slug" class="form-label">Slug (URL)</label>
                <input type="text" name="slug" id="slug" class="form-control" value="<?= e($post['slug'] ?? ''); ?>" placeholder="votre-titre-article" />
                <small class="text-muted">Laissez vide pour generer automatiquement.</small>
              </div>
              <div class="mb-3 col-md-9">
                <label for="Excerpt" class="form-label">Extrait (Resume)</label>
                <textarea rows="3" name="excerpt" id="Excerpt" class="form-control"><?= e($post['excerpt'] ?? ''); ?></textarea>
              </div>
              <div class="mb-3 col-md-9">
                <label class="form-label" for="category">Categorie</label>
                <select class="form-select" name="category" id="category" required>
                  <option value="Association" <?= ($post['category'] ?? '') === 'Association' ? 'selected' : ''; ?>>Association</option>
                  <option value="Evenement" <?= ($post['category'] ?? '') === 'Evenement' ? 'selected' : ''; ?>>Evenement</option>
                  <option value="Workshop" <?= ($post['category'] ?? '') === 'Workshop' ? 'selected' : ''; ?>>Workshop</option>
                  <option value="Marketing" <?= ($post['category'] ?? '') === 'Marketing' ? 'selected' : ''; ?>>Marketing</option>
                </select>
              </div>
            </div>
            <div class="mt-2 mb-4">
              <label class="form-label">Contenu de l'article</label>
              <div id="editor" style="height: 400px;"><?= $post['body'] ?? ''; ?></div>
            </div>
            <div class="d-flex gap-2">
              <button type="submit" onclick="submitPost('published')" class="btn btn-primary">Publier</button>
              <button type="submit" onclick="submitPost('draft')" class="btn btn-outline-secondary">Enregistrer en Brouillon</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4>Infos</h4>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Statut: <strong><?= ucfirst($post['status'] ?? 'Nouveau'); ?></strong></li>
            <li class="list-group-item">Derniere Maj: <?= isset($post['updated_at']) ? date('d/m/Y H:i', strtotime($post['updated_at'])) : 'Jamais'; ?></li>
          </ul>
        </div>
      </div>
    </div>
  </form>
</section>

<!-- Quill JS Integration -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
  var quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
      toolbar: [
        [{
          'header': [1, 2, 3, false]
        }],
        ['bold', 'italic', 'underline', 'strike'],
        ['link', 'blockquote', 'code-block', 'image'],
        [{
          'list': 'ordered'
        }, {
          'list': 'bullet'
        }]
      ]
    }
  });

  function submitPost(status) {
    document.getElementById('postBodyInput').value = quill.root.innerHTML;
    document.getElementById('postStatusInput').value = status;
  }
</script>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>