<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>

<div class="container my-5">

    <?php if (!empty($flash['error'])): ?>
      <div class="alert alert-danger rounded-0 border-0 border-start border-4 mb-4" style="border-color: #dc3545 !important; background: #fff5f5;">
          <i class="fas fa-exclamation-triangle me-2"></i> <?= esc($flash['error']) ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($flash['success'])): ?>
      <div class="alert alert-success rounded-0 border-0 border-start border-4 mb-4" style="border-color: #28a745 !important; background: #f4faf6;">
          <i class="fas fa-check-circle me-2"></i> <?= esc($flash['success']) ?>
      </div>
    <?php endif; ?>

    <!-- EN-TETE PROFIL -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-top: 4px solid var(--el-gold) !important;">
                
                <!-- Bannière décorative -->
                <div style="height: 130px; background: linear-gradient(135deg, var(--el-black) 0%, var(--el-dark-grey) 50%, var(--el-black) 100%); position: relative;">
                    <div style="position:absolute; bottom:0; left:0; right:0; height:50px; background: linear-gradient(to top, #fff, transparent);"></div>
                    <?php if (!empty($wallet) && $wallet['is_gold']): ?>
                        <div style="position:absolute; top:15px; right:20px;">
                            <span class="py-2 px-3" style="background: linear-gradient(135deg, #d4af37, #f2d06b); color: var(--el-black); letter-spacing:2px; font-size:0.7rem; font-weight:700; display:inline-block;">
                                <i class="fas fa-crown me-1"></i> MEMBRE GOLD
                            </span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="px-4 pb-4" style="margin-top: -55px;">
                    <div class="d-flex flex-column flex-md-row gap-4 align-items-center align-items-md-end">
                        
                        <!-- AVATAR -->
                        <div class="text-center" style="flex-shrink:0;">
                            <?php $pic = !empty($user['profile_pic']) ? esc($user['profile_pic']) : 'default_avatar.jpg'; ?>
                            <div style="width: 110px; height: 110px; border-radius: 50%; overflow: hidden; border: 4px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.2); margin: 0 auto; position:relative;">
                                <img src="/assets/img/<?= $pic ?>" alt="Photo de profil" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        
                        <!-- INFOS PRINCIPALES -->
                        <div class="flex-grow-1 w-100 pb-1">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center align-items-md-end gap-2">
                                <div class="text-center text-md-start">
                                    <h2 style="font-family:'Playfair Display',serif; color:var(--el-black); margin:0 0 4px 0; font-size:1.6rem;">
                                        <?= isset($user['full_name']) ? esc($user['full_name']) : 'Utilisateur' ?>
                                    </h2>
                                    <p class="text-muted mb-0" style="font-size:0.82rem;">
                                        <i class="fa-solid fa-envelope me-1" style="color:var(--el-gold); font-size:0.75rem;"></i>
                                        <?= isset($user['email']) ? esc($user['email']) : '—' ?>
                                        <span class="mx-2" style="color:#ddd;">|</span>
                                        <i class="fa-solid fa-calendar me-1" style="color:var(--el-gold); font-size:0.75rem;"></i>
                                        Membre depuis <?= esc($memberSince) ?>
                                    </p>
                                </div>
                                <div class="d-flex gap-2 align-items-center">
                                    <form action="/profile/update-pic" method="POST" enctype="multipart/form-data" class="d-inline">
                                        <label for="profile_pic" class="btn btn-outline-elegant btn-sm px-3" style="cursor: pointer; font-size:0.72rem; letter-spacing:1px;">
                                            <i class="fa-solid fa-camera me-1"></i> PHOTO
                                        </label>
                                        <input type="file" id="profile_pic" name="profile_pic" accept="image/*" class="d-none" onchange="this.form.submit()">
                                    </form>
                                    <?php if (!empty($wallet) && $wallet['is_gold']): ?>
                                        <span style="background: linear-gradient(135deg, #d4af37, #f2d06b); color: var(--el-black); padding: 5px 14px; font-size:0.72rem; letter-spacing:1px; font-weight:700; display:inline-block;">
                                            <i class="fas fa-crown me-1"></i> GOLD
                                        </span>
                                    <?php else: ?>
                                        <span style="background:#f5f5f5; color:#999; padding: 5px 14px; font-size:0.72rem; letter-spacing:1px; font-weight:600; border: 1px solid #e0e0e0; display:inline-block;">
                                            STANDARD
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STATISTIQUES RAPIDES -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-10">
            <div class="row g-3">
                <!-- Solde -->
                <div class="col-6 col-md-3">
                    <div class="stat-card card border-0 shadow-sm h-100" style="border-top: 3px solid var(--el-gold) !important;">
                        <i class="fa-solid fa-wallet mb-2" style="font-size:1.3rem; color:var(--el-gold);"></i>
                        <h3 style="font-size:1.4rem; margin:0;">
                            <?= number_format($wallet['balance'] ?? 0, 0, ',', ' ') ?> <small style="font-size:0.65rem; color:#888;">€</small>
                        </h3>
                        <p>Solde</p>
                    </div>
                </div>
                
                <!-- Abonnements -->
                <div class="col-6 col-md-3">
                    <div class="stat-card card border-0 shadow-sm h-100" style="border-top: 3px solid #28a745 !important;">
                        <i class="fa-solid fa-utensils mb-2" style="font-size:1.3rem; color:#28a745;"></i>
                        <h3 style="font-size:1.4rem; margin:0;">
                            <?= $subscriptionCount ?? 0 ?>
                        </h3>
                        <p>Programmes</p>
                    </div>
                </div>

                <!-- Mesures -->
                <div class="col-6 col-md-3">
                    <div class="stat-card card border-0 shadow-sm h-100" style="border-top: 3px solid #6B46C1 !important;">
                        <i class="fa-solid fa-weight-scale mb-2" style="font-size:1.3rem; color:#6B46C1;"></i>
                        <h3 style="font-size:1.4rem; margin:0;">
                            <?= $measureCount ?? 0 ?>
                        </h3>
                        <p>Mesures</p>
                    </div>
                </div>

                <!-- Statut -->
                <div class="col-6 col-md-3">
                    <?php $isGold = !empty($wallet) && $wallet['is_gold']; ?>
                    <div class="stat-card card border-0 shadow-sm h-100" style="border-top: 3px solid <?= $isGold ? '#d4af37' : '#ccc' ?> !important;">
                        <i class="fa-solid fa-crown mb-2" style="font-size:1.3rem; color:<?= $isGold ? '#d4af37' : '#ccc' ?>;"></i>
                        <h3 style="font-size:1.4rem; margin:0;">
                            <?= $isGold ? 'Gold' : 'Free' ?>
                        </h3>
                        <p>Statut</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row g-4">

                <!-- COLONNE GAUCHE : Infos Personnelles -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-4 h-100" style="border-top: 3px solid var(--el-black) !important;">
                        <h5 class="text-uppercase mb-4" style="font-size:0.78rem; letter-spacing:2px; color:var(--el-gold-dark); border-bottom: 1px solid #eee; padding-bottom:10px;">
                            <i class="fa-solid fa-user me-2"></i> Informations Personnelles
                        </h5>
                        
                        <div class="mb-3">
                            <span class="text-muted text-uppercase d-block mb-1" style="font-size:0.68rem; letter-spacing:1px;">Nom Complet</span>
                            <span class="fw-bold" style="color:var(--el-black);"><?= isset($user['full_name']) ? esc($user['full_name']) : '—' ?></span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted text-uppercase d-block mb-1" style="font-size:0.68rem; letter-spacing:1px;">Email</span>
                            <span class="fw-bold" style="color:var(--el-black);"><?= isset($user['email']) ? esc($user['email']) : '—' ?></span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted text-uppercase d-block mb-1" style="font-size:0.68rem; letter-spacing:1px;">Genre</span>
                            <span class="fw-bold" style="color:var(--el-black);"><?= isset($user['genre']) && $user['genre'] ? esc(ucfirst($user['genre'])) : 'Non renseigné' ?></span>
                        </div>

                        <div class="mb-0">
                            <span class="text-muted text-uppercase d-block mb-1" style="font-size:0.68rem; letter-spacing:1px;">Rôle</span>
                            <span class="fw-bold text-capitalize" style="color:var(--el-black);"><?= isset($user['role']) ? esc($user['role']) : 'user' ?></span>
                        </div>
                    </div>
                </div>

                <!-- COLONNE DROITE : Données Santé -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-4 h-100" style="border-top: 3px solid #28a745 !important;">
                        <h5 class="text-uppercase mb-4" style="font-size:0.78rem; letter-spacing:2px; color:#28a745; border-bottom: 1px solid #eee; padding-bottom:10px;">
                            <i class="fa-solid fa-heart-pulse me-2"></i> Données Santé
                        </h5>
                        
                        <?php if (!empty($measures) && !empty($measures['weight_kg'])): ?>
                            <div class="mb-3">
                                <span class="text-muted text-uppercase d-block mb-1" style="font-size:0.68rem; letter-spacing:1px;">Dernier Poids</span>
                                <span class="fw-bold" style="color:var(--el-black); font-size:1.15rem;">
                                    <?= esc($measures['weight_kg']) ?> <small class="text-muted">kg</small>
                                </span>
                            </div>
                            
                            <?php if (!empty($measures['waist_cm'])): ?>
                            <div class="mb-3">
                                <span class="text-muted text-uppercase d-block mb-1" style="font-size:0.68rem; letter-spacing:1px;">Tour de Taille</span>
                                <span class="fw-bold" style="color:var(--el-black);"><?= esc($measures['waist_cm']) ?> <small class="text-muted">cm</small></span>
                            </div>
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <span class="text-muted text-uppercase d-block mb-1" style="font-size:0.68rem; letter-spacing:1px;">Date du Relevé</span>
                                <span class="fw-bold" style="color:var(--el-black);"><?= date('d/m/Y à H:i', strtotime($measures['measured_at'])) ?></span>
                            </div>
                            
                            <?php if (!empty($measures['notes'])): ?>
                            <div class="mb-0">
                                <span class="text-muted text-uppercase d-block mb-1" style="font-size:0.68rem; letter-spacing:1px;">Notes IMC</span>
                                <span style="color:var(--el-black); font-size:0.9rem;"><?= esc($measures['notes']) ?></span>
                            </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="text-center py-3">
                                <i class="fa-solid fa-notes-medical" style="font-size:2.5rem; color:#e0e0e0; margin-bottom:12px; display:block;"></i>
                                <p class="text-muted mb-3" style="font-size:0.85rem;">Aucune donnée santé enregistrée.</p>
                                <a href="/register-health" class="btn btn-elegant btn-sm px-4">
                                    <i class="fa-solid fa-plus me-1"></i> AJOUTER MES DONNÉES
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION PREMIUM / PORTEFEUILLE -->
    <div class="row justify-content-center mt-4">
        <div class="col-lg-10">
            <?php if (empty($wallet) || !$wallet['is_gold']): ?>
                <!-- Bannière incitation Gold -->
                <div class="card border-0 shadow-sm overflow-hidden" style="background: var(--el-black);">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <div class="p-4 p-md-5 flex-grow-1">
                            <span class="d-inline-block mb-2 px-3 py-1" style="background: linear-gradient(135deg, #d4af37, #f2d06b); color: var(--el-black); font-size:0.65rem; letter-spacing:2px; font-weight:700;">
                                OFFRE EXCLUSIVE
                            </span>
                            <h3 style="font-family:'Playfair Display',serif; color:#fff; margin-bottom:8px; font-size:1.35rem;">
                                Passez au statut <span style="color:var(--el-gold);">Gold</span>
                            </h3>
                            <p style="color:#aaa; font-size:0.82rem; margin-bottom:15px; max-width:450px;">
                                Profitez d'une remise permanente de <strong style="color:var(--el-gold);">15%</strong> sur tous vos programmes nutritionnels. Un investissement unique de 20 €.
                            </p>
                            <a href="/wallet" class="btn btn-elegant btn-sm px-4">
                                <i class="fa-solid fa-crown me-2"></i> DÉCOUVRIR L'OFFRE
                            </a>
                        </div>
                        <div class="d-none d-md-flex align-items-center justify-content-center p-5" style="min-width:160px;">
                            <i class="fa-solid fa-crown" style="font-size:4.5rem; color:var(--el-gold); opacity:0.2;"></i>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Statut Gold confirmé -->
                <div class="card border-0 shadow-sm p-4" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2518 100%); border: 1px solid var(--el-gold) !important;">
                    <div class="d-flex flex-column flex-sm-row align-items-center gap-3">
                        <i class="fa-solid fa-crown" style="font-size:1.4rem; color:var(--el-gold);"></i>
                        <div class="text-center text-sm-start flex-grow-1">
                            <h6 style="color:var(--el-gold); margin:0; font-size:0.82rem; letter-spacing:2px; text-transform:uppercase;">Membre Gold Actif</h6>
                            <p style="color:#aaa; margin:0; font-size:0.78rem;">Remise de 15% active sur tous les programmes</p>
                        </div>
                        <a href="/wallet" class="btn btn-elegant btn-sm px-4">
                            MON PORTEFEUILLE
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ACTIONS RAPIDES -->
    <div class="row justify-content-center mt-4 mb-3">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="text-uppercase mb-3" style="font-size:0.78rem; letter-spacing:2px; color:var(--el-gold-dark); border-bottom: 1px solid #eee; padding-bottom:10px;">
                    <i class="fa-solid fa-compass me-2"></i> Actions Rapides
                </h5>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="/register-health" class="btn btn-elegant btn-sm px-3 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-heart-pulse"></i> Santé
                    </a>
                    <a href="/wallet" class="btn btn-outline-elegant btn-sm px-3 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-wallet"></i> Portefeuille
                    </a>
                    <a href="/regimes" class="btn btn-outline-elegant btn-sm px-3 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-utensils"></i> Programmes
                    </a>
                    <a href="/recommandation" class="btn btn-outline-elegant btn-sm px-3 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-star"></i> Recommandations
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>