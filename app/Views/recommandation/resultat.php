<?= view('templates/header') ?>

<style>
    .result-section {
        display: flex;
        gap: 30px;
        margin-top: 40px;
    }
    .imc-box {
        flex: 1;
        background-color: var(--accent);
        color: white;
        text-align: center;
        padding: 40px 20px;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(212, 175, 55, 0.2);
    }
    .imc-box h1 {
        color: white;
        font-size: 48px;
        margin: 10px 0;
    }
    .imc-box p {
        font-size: 16px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .programme-box {
        flex: 2;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .sub-card {
        background: #fff;
        border-left: 5px solid var(--accent);
        padding: 30px;
        border-radius: 6px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.04);
    }
    .sub-card h3 {
        color: var(--accent);
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 15px;
        margin-top: 0;
    }
    .stats {
        display: flex;
        gap: 20px;
        margin-top: 20px;
    }
    .stat-item {
        background: #f9f9f9;
        padding: 15px 20px;
        border-radius: 8px;
        flex: 1;
        text-align: center;
    }
    .stat-item strong {
        display: block;
        font-size: 24px;
        color: var(--text-main);
        font-family: 'Playfair Display', serif;
    }
    .stat-item span {
        font-size: 12px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<div class="chic-card">
    <h2 style="text-align: center;">Votre Prescription Élégante</h2>
    <p style="text-align: center; color: var(--text-muted);">Basée sur vos mensurations et vos objectifs.</p>

    <div class="result-section">
        <div class="imc-box">
            <p>Votre Indice de Masse Corporelle</p>
            <h1><?= isset($imc) ? $imc : 'N/A' ?></h1>
            <p style="font-size: 14px; margin-top: 20px; opacity: 0.9;">
                <?php 
                    if(isset($imc)) {
                        if ($imc < 18.5) echo "Insuffisance pondérale";
                        elseif ($imc < 25) echo "Corpulence normale";
                        elseif ($imc < 30) echo "Surpoids";
                        else echo "Obésité";
                    }
                ?>
            </p>
        </div>

        <div class="programme-box">
            <div class="sub-card">
                <h3>Régime Alimentaire Conseillé : <?= isset($regime) && $regime ? esc($regime['nom']) : 'Régime Sur-mesure' ?></h3>
                <p><?= isset($regime) && $regime ? esc($regime['description']) : 'Ce programme détaillé a pour objectif de vous apporter un équilibre parfait entre nutrition et saveurs, adapté à votre physiologie.' ?></p>
                
                <?php if(isset($regime) && isset($regime['prix_journalier'])): ?>
                <div style="margin-top: 15px; font-weight: bold; color: var(--text-main);">
                    Tarif d'accompagnement : <?= number_format($regime['prix_journalier'], 2, ',', ' ') ?> Ar / jour
                </div>
                <?php endif; ?>
            </div>

            <div class="sub-card">
                <h3>Activité Physique Associée : <?= isset($activite) && $activite ? esc($activite['nom']) : 'Vitalité Douce' ?></h3>
                <p><?= isset($activite) && $activite ? esc($activite['description']) : 'Pour sculpter votre corps et l\'harmoniser avec votre nouveau régime diététique. Fréquence : 3 à 4 séances hebdomadaires.' ?></p>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 50px;">
        <a href="/recommandation" class="btn-chic" style="background-color: var(--text-main);">← Refaire une simulation</a>
        <a href="/export/pdf/<?= isset($imc) ? $imc : 0 ?>" class="btn-chic">💳 Exporter & Activer (Code Wallet)</a>
    </div>
</div>

<?= view('templates/footer') ?>