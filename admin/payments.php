<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

if (isset($_GET['action'])) {
    $id = (int) ($_GET['id'] ?? 0);
    $status = $_GET['action'] === 'confirm' ? 'paid' : 'rejected';
    if (update_payment_status($id, $status)) {
        set_flash('success', 'Statut du paiement mis à jour.');
    } else {
        set_flash('danger', 'Erreur de mise à jour.');
    }
    redirect_to('admin/payments.php');
}

$pageTitle = 'CECOB | Paiements';
$adminPage = 'payments';
$payments = fetch_all_payments();

require_once __DIR__ . '/../includes/admin_header.php';
?>
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="h2 fw-bold">Gestion des Paiements</h1>
            <p class="text-muted">Suivi des cotisations et dons.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table mb-0 text-nowrap table-centered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Membre</th>
                                <th>Montant</th>
                                <th>Methode</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $p): ?>
                                <tr>
                                    <td>
                                        <h5 class="mb-0"><?= e($p['full_name'] ?: 'Donateur Anonyme'); ?></h5>
                                        <?php if ($p['member_number']): ?>
                                            <small class="text-muted"><?= e($p['member_number']); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-bold"><?= number_format($p['amount'], 0, ',', ' '); ?> BIF</td>
                                    <td><?= e($p['method']); ?></td>
                                    <td>
                                        <span class="badge bg-<?php
                                                                echo match ($p['status']) {
                                                                    'paid' => 'success',
                                                                    'pending' => 'warning',
                                                                    'rejected' => 'danger',
                                                                    default => 'secondary'
                                                                };
                                                                ?>-soft">
                                            <?= ucfirst($p['status']); ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($p['created_at'])); ?></td>
                                    <td>
                                        <?php if ($p['status'] === 'pending'): ?>
                                            <a href="?action=confirm&id=<?= $p['id']; ?>" class="btn btn-success btn-sm">Confirmer</a>
                                            <a href="?action=reject&id=<?= $p['id']; ?>" class="btn btn-outline-danger btn-sm">Rejeter</a>
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