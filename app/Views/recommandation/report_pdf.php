 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #D4AF37; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { color: #D4AF37; margin: 0; }
        .section-title { background-color: #f8f9fa; padding: 10px; border-left: 5px solid #D4AF37; margin: 20px 0 10px 0; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .highlight { color: #D4AF37; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h1>L'Élégance Nutrition 🌿</h1>
        <p>Bilan Personnel de <strong><?= $user['username'] ?></strong> | Date : <?= date('d/m/Y') ?></p>
    </div>

    <div class="section-title">VOTRE BILAN ANTHROPOMÉTRIQUE</div>
    <table>
        <tr>
            <th>Taille</th>
            <td><?= $profile['height'] ?> cm</td>
        </tr>
        <tr>
            <th>Poids actuel</th>
            <td><?= $profile['weight'] ?> kg</td>
        </tr>
        <tr>
            <th>Indice de Masse Corporelle (IMC)</th>
            <td class="highlight"><?= number_format($imc, 1) ?></td>
        </tr>
    </table>

    <div class="section-title"> VOTRE PROGRAMME NUTRITIONNEL</div>
    <p>Objectif : <strong><?= $user['goal'] ?></strong></p>
    <table>
        <thead>
            <tr>
                <th>Moment</th>
                <th>Repas conseillés</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($menu as $repas): ?>
            <tr>
                <td><strong><?= $repas['moment'] ?></strong></td>
                <td><?= $repas['plat'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="section-title"> ACTIVITÉS PHYSIQUES RECOMMANDÉES</div>
    <ul>
        <?php foreach($activities as $activity): ?>
            <li><strong><?= $activity['name'] ?></strong> : <?= $activity['duration'] ?> minutes (<?= $activity['frequency'] ?>)</li>
        <?php endforeach; ?>
    </ul>

</body>
</html>