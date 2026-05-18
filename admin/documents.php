<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = (int) ($_GET['id'] ?? 0);
    // Suggestion: query file path first to delete physically if needed, but let's just delete DB record for now
    if (delete_record('documents', $id)) {
        set_flash('success', 'Document supprime.');
    } else {
        set_flash('danger', 'Erreur lors de la suppression.');
    }
    redirect_to('admin/documents.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $title = $_POST['title'] ?? '';
    $category = $_POST['category'] ?? '';
    $visibility = $_POST['visibility'] ?? 'public';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $path = upload_file($_FILES['file'], 'uploads/documents');
        if ($path) {
            $data = [
                'title' => $title,
                'category' => $category,
                'file_path' => $path,
                'visibility' => $visibility
            ];
            if (save_document($data)) {
                set_flash('success', 'Document ajoute avec succes.');
            } else {
                set_flash('danger', 'Erreur lors de l\'enregistrement en base.');
            }
        } else {
            set_flash('danger', 'Erreur lors du telechargement du fichier.');
        }
    } else {
        set_flash('danger', 'Veuillez selectionner un fichier valide.');
    }
    redirect_to('admin/documents.php');
}

$pageTitle = 'CECOB | Documents';
$adminPage = 'documents';
$documents = fetch_all_documents();

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 text-center mb-4">
            <h1 class="h2 fw-bold">Gestion Documentaire</h1>
            <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#uploadForm">Nouveau Document</button>
        </div>
    </div>

    <div class="row collapse mb-4" id="uploadForm">
        <div class="offset-xl-3 col-xl-6 col-12">
            <div class="card border-primary">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
                        <div class="mb-3">
                            <label class="form-label">Titre du document</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categorie</label>
                            <select name="category" class="form-select">
                                <option value="Statuts">Statuts</option>
                                <option value="Rapports">Rapports</option>
                                <option value="Formulaires">Formulaires</option>
                                <option value="Autres">Autres</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Visibilite</label>
                            <select name="visibility" class="form-select">
                                <option value="public">Public (Tout le monde)</option>
                                <option value="members">Membres uniquement</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fichier (PDF, Docx, etc.)</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Envoyer le document</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table mb-0 text-nowrap table-centered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Document</th>
                                <th>Categorie</th>
                                <th>Visibilite</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($documents as $doc): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fe fe-file-text fs-3 me-3 text-primary"></i>
                                            <h5 class="mb-0"><?= e($doc['title']); ?></h5>
                                        </div>
                                    </td>
                                    <td><?= e($doc['category']); ?></td>
                                    <td>
                                        <span class="badge bg-<?= $doc['visibility'] === 'public' ? 'info' : 'warning'; ?>-soft">
                                            <?= ucfirst($doc['visibility']); ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($doc['created_at'])); ?></td>
                                    <td>
                                        <a href="<?= e(app_url($doc['file_path'])); ?>" class="btn btn-icon btn-ghost btn-sm rounded-circle" target="_blank">
                                            <i class="fe fe-download"></i>
                                        </a>
                                        <a href="?action=delete&id=<?= $doc['id']; ?>" class="btn btn-icon btn-ghost btn-sm rounded-circle text-danger" onclick="return confirm('Supprimer ce document ?')">
                                            <i class="fe fe-trash"></i>
                                        </a>
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