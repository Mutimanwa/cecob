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
  <form action="" method="POST" enctype="multipart/form-data" id="postForm" onsubmit="return prepareFormSubmission();">
    <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
    <input type="hidden" name="body" id="postBodyInput">
    <input type="hidden" name="status" id="postStatusInput" value="<?= e($post['status'] ?? 'published'); ?>">

    <div class="row gy-4">
      <div class="col-xl-9 col-lg-8 col-md-12 col-12">
        <div class="card border-0">
          <div class="card-header">
            <h4 class="mb-0">Contenu de l'article</h4>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">Image de couverture</label>
              <div class="custom-file-container" data-upload-id="courseImage">
                <label>Choisir une image <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Effacer">&times;</a></label>
                <label class="custom-file-container__custom-file">
                  <input type="file" name="image" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                  <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                  <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview" style="<?= $post && $post['image_path'] ? 'background-image: url(' . e(app_url($post['image_path'])) . ');' : ''; ?>"></div>
              </div>
            </div>

            <div class="row">
              <div class="mb-3 col-md-12">
                <label for="postTitle" class="form-label">Titre <span class="text-danger">*</span></label>
                <input type="text" name="title" id="postTitle" class="form-control" value="<?= e($post['title'] ?? ''); ?>" placeholder="Titre de l'article" required />
              </div>
              <div class="mb-3 col-md-12">
                <label for="slug" class="form-label">Slug (URL)</label>
                <input type="text" name="slug" id="slug" class="form-control" value="<?= e($post['slug'] ?? ''); ?>" placeholder="votre-titre-article" />
                <small class="text-muted">Laissez vide pour générer automatiquement à partir du titre.</small>
              </div>
              <div class="mb-3 col-md-12">
                <label for="Excerpt" class="form-label">Extrait / Résumé <span class="text-danger">*</span></label>
                <textarea rows="3" name="excerpt" id="Excerpt" class="form-control" placeholder="Bref résumé de l'article pour les listes" required><?= e($post['excerpt'] ?? ''); ?></textarea>
              </div>
              <div class="mb-3 col-md-12">
                <label class="form-label" for="category">Catégorie <span class="text-danger">*</span></label>
                <select class="form-select" name="category" id="category" required>
                  <option value="" disabled <?= !isset($post['category']) ? 'selected' : ''; ?>>Sélectionnez une catégorie</option>
                  <option value="Vie associative" <?= ($post['category'] ?? '') === 'Vie associative' ? 'selected' : ''; ?>>Vie associative</option>
                  <option value="Communiqué" <?= ($post['category'] ?? '') === 'Communiqué' ? 'selected' : ''; ?>>Communiqué</option>
                  <option value="Événement" <?= ($post['category'] ?? '') === 'Événement' ? 'selected' : ''; ?>>Événement</option>
                  <option value="Workshop" <?= ($post['category'] ?? '') === 'Workshop' ? 'selected' : ''; ?>>Workshop</option>
                  <option value="Marketing" <?= ($post['category'] ?? '') === 'Marketing' ? 'selected' : ''; ?>>Marketing</option>
                </select>
              </div>
            </div>

            <div class="mt-2 mb-4">
              <label class="form-label">Corps de l'article <span class="text-danger">*</span></label>
              <div id="editor" style="height: 400px;"><?= $post['body'] ?? ''; ?></div>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" onclick="document.getElementById('postStatusInput').value = 'published'" class="btn btn-primary">Publier</button>
              <button type="submit" onclick="document.getElementById('postStatusInput').value = 'draft'" class="btn btn-outline-secondary">Enregistrer en Brouillon</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-lg-4 col-md-12 col-12">
        <div class="card mb-4">
          <div class="card-header">
            <h4 class="mb-0">Informations</h4>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Statut: <span class="badge bg-<?= ($post['status'] ?? '') === 'published' ? 'success' : 'warning'; ?>"><?= ucfirst($post['status'] ?? 'Nouveau'); ?></span>
            </li>
            <?php if ($post): ?>
              <li class="list-group-item">
                <small class="text-muted">Créé le : <?= date('d/m/Y H:i', strtotime($post['published_at'])); ?></small>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </form>
</section>

<!-- <script>
  function prepareFormSubmission() {
    // Sync Quill content to hidden input
    const editor = document.querySelector('.ql-editor');
    const bodyInput = document.getElementById('postBodyInput');

    // Check if it's empty
    if (editor.innerText.trim() === '' && !editor.querySelector('img')) {
      alert('Le corps de l\'article ne peut pas être vide.');
      return false;
    }

    bodyInput.value = editor.innerHTML;
    return true;
  }
</script> -->

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>