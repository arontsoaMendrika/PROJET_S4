<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<div class="container mb-5">
    <div class="text-center mb-5">
        <h2 style="font-family:'Playfair Display',serif; color:var(--el-black);">Modifier une Formule</h2>
        <div style="width: 50px; height: 2px; background-color: var(--el-gold); margin: 10px auto;"></div>
        <p class="text-muted">Mettez à jour le programme : <?= esc($regime['name']) ?></p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Messages -->
            <?php if (isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger rounded-0 border-0 border-start border-4" style="border-color: var(--el-gold) !important;">
                    <i class="fas fa-exclamation-circle me-2"></i><strong>Erreurs de validation:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm rounded-0 p-4" style="background:#fff;">
                <form action="<?= base_url('regime/update/' . $regime['id']) ?>" method="POST">
                    
                    <h5 class="text-uppercase mb-4 mt-2" style="font-size:0.9rem; letter-spacing:1px; color:var(--el-gold-dark);">Informations Générales</h5>
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label small text-muted text-uppercase">Nom de la Formule *</label>
                            <input type="text" name="name" class="form-control rounded-0 border-dark" required value="<?= esc($_SESSION['old']['name'] ?? $regime['name']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Type de Régime *</label>
                            <select name="regime_type_id" class="form-select rounded-0 border-dark" required>
                                <?php if(isset($types) && is_array($types)): ?>
                                    <?php foreach ($types as $type): ?>
                                        <option value="<?= esc($type['id']) ?>" <?= ((isset($_SESSION['old']['regime_type_id']) && $_SESSION['old']['regime_type_id'] == $type['id']) || (!isset($_SESSION['old']['regime_type_id']) && $regime['regime_type_id'] == $type['id'])) ? 'selected' : '' ?>><?= esc($type['name']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small text-muted text-uppercase">Description *</label>
                        <textarea name="description" class="form-control rounded-0 border-dark" rows="4" required><?= esc($_SESSION['old']['description'] ?? $regime['description']) ?></textarea>
                    </div>

                    <hr class="text-muted opacity-25 mb-4">
                    <h5 class="text-uppercase mb-4" style="font-size:0.9rem; letter-spacing:1px; color:var(--el-gold-dark);">Paramètres Nutritionnels</h5>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label small text-muted text-uppercase">Objectif Principal *</label>
                            <select name="goal" class="form-select rounded-0 border-dark" required>
                                <?php $currentGoal = $_SESSION['old']['goal'] ?? $regime['goal']; ?>
                                <option value="weight_loss" <?= $currentGoal == 'weight_loss' ? 'selected' : '' ?>>Perte de poids</option>
                                <option value="maintenance" <?= $currentGoal == 'maintenance' ? 'selected' : '' ?>>Maintien</option>
                                <option value="muscle_gain" <?= $currentGoal == 'muscle_gain' ? 'selected' : '' ?>>Prise de masse</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Durée recommandée (Jours)</label>
                            <input type="number" name="duration_days" class="form-control rounded-0 border-dark" value="<?= esc($_SESSION['old']['duration_days'] ?? $regime['duration_days']) ?>">
                        </div>
                    </div>

                    <hr class="text-muted opacity-25 mb-4">
                    <h5 class="text-uppercase mb-4" style="font-size:0.9rem; letter-spacing:1px; color:var(--el-gold-dark);">Aspect Financier</h5>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Prix par jour (€) *</label>
                            <div class="input-group rounded-0">
                                <input type="number" step="0.01" name="price_per_day" class="form-control rounded-0 border-dark border-end-0" required value="<?= esc($_SESSION['old']['price_per_day'] ?? $regime['price_per_day']) ?>">
                                <span class="input-group-text bg-white border-dark rounded-0 border-start-0 text-muted"><i class="fas fa-euro-sign"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="<?= base_url('regime/show/' . $regime['id']) ?>" class="btn btn-outline-dark rounded-0 py-2 px-4 text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem;">Annuler</a>
                        <button type="submit" class="btn btn-elegant py-2 px-5 text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem;">
                            Mettre à jour
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
