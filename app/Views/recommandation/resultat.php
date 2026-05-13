<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<div class="container mb-5">
    <div class="text-center mb-5">
        <h2 style="font-family:'Playfair Display',serif; color:var(--el-black);">Votre Prescription Élégante</h2>
        <div style="width: 50px; height: 2px; background-color: var(--el-gold); margin: 10px auto;"></div>
        <p class="text-muted">Basée sur vos mensurations et vos objectifs.</p>
    </div>

    <div class="row align-items-stretch mb-5">
        
        <!-- IMC -->
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="card border-0 rounded-0 shadow-sm h-100 p-5 d-flex flex-column justify-content-center align-items-center" style="background-color: var(--el-black); color: white; border-top: 4px solid var(--el-gold) !important;">
                <p class="text-uppercase text-center mb-4" style="font-size:0.85rem; letter-spacing:1px; color:var(--el-gold);">Votre Indice de Masse Corporelle</p>
                <h1 style="font-family:'Playfair Display', serif; font-size:4rem; color:white; margin:0;">
                    <?= isset($imc) ? number_format($imc, 2) : 'N/A' ?>
                </h1>
                <div class="mt-4 px-4 py-2" style="background:rgba(255,255,255,0.05); border:1px solid rgba(197, 160, 89, 0.3);">
                    <p class="text-uppercase mb-0 text-center" style="font-size:0.8rem; letter-spacing:1px;">
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
            </div>
        </div>

        <!-- Recommandations -->
        <div class="col-md-8">
            <div class="d-flex flex-column gap-4 h-100">
                
                <!-- Programme Alimentaire -->
                <div class="card border-0 shadow-sm rounded-0 p-4" style="background:#fff; border-left: 4px solid var(--el-gold) !important;">
                    <h5 class="text-uppercase mb-3" style="font-size:0.85rem; letter-spacing:1px; color:var(--el-gold-dark);">Régime Alimentaire Conseillé</h5>
                    <h3 style="font-family:'Playfair Display',serif; color:var(--el-black); margin-bottom:1rem;">
                        <?= isset($regime) && $regime ? esc($regime['name']) : 'Régime Sur-mesure' ?>
                    </h3>
                    <p class="text-muted" style="line-height:1.7;">
                        <?= isset($regime) && $regime ? esc($regime['description']) : 'Ce programme détaillé a pour objectif de vous apporter un équilibre parfait entre nutrition et saveurs, adapté Ã  votre physiologie.' ?>
                    </p>
                    
                    <?php if(isset($regime) && isset($regime['price_per_day'])): ?>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                        <span class="text-uppercase text-muted" style="font-size:0.75rem; letter-spacing:1px;">Tarif d'accompagnement</span>
                        <strong style="color:var(--el-gold-dark); font-size:1.1rem;"><?= number_format($regime['price_per_day'], 2, ',', ' ') ?> â‚¬ <small class="text-muted fw-normal" style="font-size:0.8rem;">/ jour</small></strong>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Activité Physique -->
                <div class="card border-0 shadow-sm rounded-0 p-4" style="background:#fff; border-left: 4px solid var(--el-dark-grey) !important;">
                    <h5 class="text-uppercase mb-3" style="font-size:0.85rem; letter-spacing:1px; color:var(--el-dark-grey);">Activité Physique Associée</h5>
                    <h3 style="font-family:'Playfair Display',serif; color:var(--el-black); margin-bottom:1rem;">
                        <?= isset($activite) && $activite ? esc($activite['name']) : 'Vitalité Douce' ?>
                    </h3>
                    <p class="text-muted mb-0" style="line-height:1.7;">
                        <?= isset($activite) && $activite ? esc($activite['description']) : 'Pour sculpter votre corps et l\'harmoniser avec votre nouveau régime diététique. Fréquence : 3 Ã  4 séances hebdomadaires.' ?>
                    </p>
                    <?php if(isset($activite) && isset($activite['calories_burned_per_hour'])): ?>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                        <span class="text-uppercase text-muted" style="font-size:0.75rem; letter-spacing:1px;">Dépense énergétique estimée</span>
                        <span class="badge" style="background:var(--el-dark-grey); color:var(--el-gold); font-weight:normal; border-radius:0; letter-spacing:1px;">
                            <?= esc($activite['calories_burned_per_hour']) ?> Kcal/h
                        </span>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="<?= base_url('recommandation') ?>" class="btn btn-outline-dark rounded-0 py-2 px-5 text-uppercase" style="letter-spacing:1px; font-size:0.85rem;">
            <i class="fas fa-arrow-left me-2"></i> Refaire une analyse
        </a>
    </div>

</div>
<?= $this->endSection() ?>
