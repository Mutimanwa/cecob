<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

if (isset($_GET['action'])) {
    $id = (int) ($_GET['id'] ?? 0);
    if ($_GET['action'] === 'read') {
        update_contact_status($id, 'read');
    } elseif ($_GET['action'] === 'delete') {
        delete_record('contact_messages', $id);
    }
    redirect_to('admin/contact-messages.php');
}

$pageTitle = 'CECOB | Messages';
$adminPage = 'contact';
$messages = fetch_contact_messages(); // Assuming this returns all columns including message content

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="h2 fw-bold">Messages de Contact</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table mb-0 text-nowrap table-centered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Expediteur</th>
                                <th>Objet / Message</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $msg): ?>
                                <tr class="<?= $msg['status'] === 'new' ? 'fw-bold' : ''; ?>">
                                    <td>
                                        <?= e($msg['name']); ?><br>
                                        <small class="text-muted"><?= e($msg['email']); ?></small>
                                    </td>
                                    <td style="max-width: 400px; white-space: normal;">
                                        <div class="mb-1"><?= e($msg['subject']); ?></div>
                                        <small class="text-muted d-block text-truncate" title="<?= e($msg['message']); ?>">
                                            <?= e($msg['message']); ?>
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= $msg['status'] === 'new' ? 'primary' : 'secondary'; ?>-soft">
                                            <?= $msg['status'] === 'new' ? 'Nouveau' : 'Lu'; ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($msg['created_at'])); ?></td>
                                    <td>
                                        <span class="dropdown dropstart">
                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu">
                                                <?php if ($msg['status'] === 'new'): ?>
                                                    <a class="dropdown-item" href="?action=read&id=<?= $msg['id']; ?>">
                                                        <i class="fe fe-check dropdown-item-icon"></i> Marquer comme lu
                                                    </a>
                                                <?php endif; ?>
                                                <a class="dropdown-item text-danger" href="?action=delete&id=<?= $msg['id']; ?>" onclick="return confirm('Supprimer ce message ?')">
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