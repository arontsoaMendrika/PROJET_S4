<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>

<?php if (!empty($profile['height']) && !empty($profile['weight'])): ?>
    <a href="<?= base_url('recommandation/exportPDF') ?>" class="btn btn-primary">
         Télécharger mon programme (PDF)
    </a>
<?php else: ?>
    <div class="alert alert-warning">
         Veuillez compléter votre profil (taille et poids) pour générer votre programme.
    </div>
    <button class="btn btn-secondary" disabled>Télécharger mon programme (PDF)</button>
<?php endif; ?>

<div class="container py-5">
    <h2 class="mb-4" style="font-family:'Playfair Display', serif;">Tableau de Bord Admin</h2>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center" style="border-top: 4px solid #d4af37 !important;">
                <h6 class="text-muted text-uppercase small">Revenus Totaux</h6>
                <h2 class="fw-bold"><?= number_format($totalRevenue, 2, ',', ' ') ?> €</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center" style="border-top: 4px solid #000 !important;">
                <h6 class="text-muted text-uppercase small">Inscriptions</h6>
                <h2 class="fw-bold"><?= $totalUsers ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center" style="border-top: 4px solid #ffc107 !important;">
                <h6 class="text-muted text-uppercase small">Membres Gold</h6>
                <h2 class="fw-bold"><?= $goldUsers ?></h2>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="mb-4">Répartition par Objectif</h5>
                <p class="text-muted italic">Emplacement pour le graphique Chart.js</p>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-4 mb-5">
    <h5 class="mb-4">Générer des codes de recharge</h5>
    <form action="<?= base_url('admin/generateCodes') ?>" method="post" class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Montant par code (€)</label>
            <input type="number" name="amount" class="form-control" placeholder="ex: 20" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Nombre de codes</label>
            <input type="number" name="count" class="form-control" placeholder="ex: 15" min="1" max="50" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-dark w-100">Générer maintenant</button>
        </div>
    </form>
</div>

<div class="row mt-5">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4">
            <h5 class="mb-4">Répartition par Objectif</h5>
            <canvas id="goalChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('goalChart').getContext('2d');
    
    // On transforme les données PHP en format utilisable par JavaScript
    const goalData = <?= json_encode($goalStats) ?>;
    
    const labels = goalData.map(item => item.goal);
    const counts = goalData.map(item => item.nb);

    new Chart(ctx, {
        type: 'pie', // Type de graphique (camembert)
        data: {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: ['#d4af37', '#000000', '#777777', '#eeeeee'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>

<div class="card border-0 shadow-sm p-4 mt-4">
    <h5 class="mb-4">Codes de recharge disponibles</h5>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Code</th>
                    <th>Valeur</th>
                    <th>Date de génération</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($availableCodes as $code): ?>
                <tr>
                    <td><strong class="text-primary"><?= $code['code_value'] ?></strong></td>
                    <td><span class="badge bg-success"><?= number_format($code['amount'], 2, ',', ' ') ?> €</span></td>
                    <td class="text-muted small"><?= date('d/m/Y H:i', strtotime($code['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($availableCodes)): ?>
                <tr>
                    <td colspan="3" class="text-center text-muted italic">Aucun code disponible pour le moment.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm p-4">
            <h5 class="mb-4">Dernières Transactions</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Utilisateur (ID)</th>
                            <th>Type</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($recentTransactions as $t): ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($t['date_transaction'])) ?></td>
                            <td>#<?= $t['user_id'] ?></td>
                            <td>
                                <span class="badge <?= $t['type_mouvement'] == 'RECHARGE' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                    <?= $t['type_mouvement'] ?>
                                </span>
                            </td>
                            <td><strong><?= number_format($t['montant'], 2, ',', ' ') ?> €</strong></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>