<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<button onclick="window.print()" class="no-print"> Enregistrer en PDF</button>

    <div class="header">
        <h1>L'Élégance Nutrition </h1>
        <p>Bilan Personnel de <strong><?= esc($user['username']) ?></strong> | Date : <?= date('d/m/Y') ?></p>
    </div>

    <div class="section-title">VOTRE BILAN ANTHROPOMÉTRIQUE</div>
    <table>
        <tr>
            <th>Taille</th>
            <td><?= esc($profile['height']) ?> cm</td>
        </tr>
        <tr>
            <th>Poids actuel</th>
            <td><?= esc($profile['weight']) ?> kg</td>
        </tr>
        <tr>
            <th>Indice de Masse Corporelle (IMC)</th>
            <td class="highlight"><?= number_format($imc, 1) ?></td>
        </tr>
    </table>

    <div class="section-title"> VOTRE PROGRAMME NUTRITIONNEL</div>
    <p>Objectif : <strong><?= esc($user['goal'] ?? 'Non défini') ?></strong></p>
    <table>
        <thead>
            <tr>
                <th style="width: 30%;">Moment</th>
                <th>Repas conseillés</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($menu)): ?>
                <?php foreach($menu as $repas): ?>
                <tr>
                    <td><strong><?= esc($repas['moment']) ?></strong></td>
                    <td><?= esc($repas['plat']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="2">Aucun menu généré.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-title"> ACTIVITÉS PHYSIQUES RECOMMANDÉES</div>
    <ul>
        <?php if (!empty($activities)): ?>
            <?php foreach($activities as $activity): ?>
                <li><strong><?= esc($activity['name']) ?></strong> : <?= esc($activity['duration']) ?> minutes (<?= esc($activity['frequency']) ?>)</li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Aucune activité spécifique recommandée.</li>
        <?php endif; ?>
    </ul>
<?= $this->endSection() ?>