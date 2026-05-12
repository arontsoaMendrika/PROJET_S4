<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Export PDF - L'Élégance Nutrition</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; line-height: 1.5; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #D4AF37; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { color: #D4AF37; margin: 0; }
        .section-title { background-color: #f8f9fa; padding: 10px; border-left: 5px solid #D4AF37; margin: 20px 0 10px 0; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .highlight { color: #D4AF37; font-weight: bold; }
        
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
            @page { margin: 1cm; }
        }

        .no-print { 
            background: #D4AF37; color: white; padding: 10px 20px; 
            border: none; border-radius: 5px; cursor: pointer; margin-bottom: 20px;
        }
    </style>
</head>
<body>

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

</body>
</html>