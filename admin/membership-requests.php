<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$status = $_GET['status'] ?? 'pending';
if (isset($_GET['action'])) {
    $id = (int) ($_GET['id'] ?? 0);
    $action = $_GET['action']; // approve or reject
    if (process_membership_request($id, $action)) {
        set_flash('success', "Demande " . ($action === 'approve' ? 'approuvee' : 'rejetee') . " avec succes.");
    } else {
        set_flash('danger', "Erreur lors du traitement de la demande.");
    }
    redirect_to("admin/membership-requests.php?status=$status");
}

$pageTitle = 'CECOB | Adhesions';
$adminPage = 'adhesions';
$requests = fetch_membership_requests($status);

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3">
                <h1 class="mb-0 h2 fw-bold">Demandes d'Adhesion</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-header border-bottom-0">
                    <ul class="nav nav-lb-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?= $status === 'pending' ? 'active' : ''; ?>" href="?status=pending">En attente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $status === 'approved' ? 'active' : ''; ?>" href="?status=approved">Approuvees</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $status === 'rejected' ? 'active' : ''; ?>" href="?status=rejected">Rejetees</a>
                        </li>
                    </ul>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 text-nowrap table-centered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Candidat</th>
                                <th>Etablissement</th>
                                <th>Contact</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($requests)): ?>
                                <tr>
                                    <td colspan="5" class="text-center p-4">Aucune demande trouvée.</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($requests as $request): ?>
                                <tr>
                                    <td>
                                        <h5 class="mb-0"><?= e($request['full_name']); ?></h5>
                                        <span class="text-muted fs-6"><?= e($request['student_id']); ?></span>
                                    </td>
                                    <td>
                                        <?= e($request['university']); ?><br>
                                        <small class="text-muted"><?= e($request['faculty']); ?></small>
                                    </td>
                                    <td>
                                        <?= e($request['email']); ?><br>
                                        <?= e($request['phone']); ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($request['created_at'])); ?></td>
                                    <td>
                                        <?php if ($status === 'pending'): ?>
                                            <a href="?action=approve&id=<?= $request['id']; ?>&status=pending" class="btn btn-success btn-sm" onclick="return confirm('Approuver cette adhesion ?')">Approuver</a>
                                            <a href="?action=reject&id=<?= $request['id']; ?>&status=pending" class="btn btn-outline-danger btn-sm" onclick="return confirm('Rejeter cette adhesion ?')">Rejeter</a>
                                        <?php else: ?>
                                            <span class="badge bg-<?= $status === 'approved' ? 'success' : 'danger'; ?>-soft"><?= ucfirst($status); ?></span>
                                        <?php endif; ?>
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