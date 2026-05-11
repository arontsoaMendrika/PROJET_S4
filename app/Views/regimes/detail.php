<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<div class="container mb-5">

    <div class="mb-4">
        <a href="<?= base_url('regimes') ?>" class="text-decoration-none text-muted"
            style="letter-spacing:1px; font-size:0.85rem; text-transform:uppercase;">
            <i class="fas fa-arrow-left me-2"></i>Retour au catalogue
        </a>
    </div>

    <!-- Détails du régime -->
    <div class="card border-0 shadow-sm rounded-0 p-5 mb-5"
        style="background:#fff; border-top: 3px solid var(--el-gold) !important;">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="badge"
                        style="background-color:var(--el-dark-grey); color:var(--el-gold); font-weight:normal; border-radius:0; letter-spacing:1px; padding:8px 12px;">
                        <?= esc($regime['type_name'] ?? 'Régime') ?>
                    </span>
                    <span class="badge bg-light text-dark border rounded-0"
                        style="font-weight:normal; letter-spacing:1px; padding:8px 12px;">
                        <i class="fas fa-fire me-2 opacity-50"></i><?= esc($regime['calories_per_day']) ?> kcal/jour
                    </span>
                    <span class="badge bg-light text-dark border rounded-0"
                        style="font-weight:normal; letter-spacing:1px; padding:8px 12px;">
                        P: <?= esc($regime['protein_percentage']) ?>% | G: <?= esc($regime['carbs_percentage']) ?>% | L:
                        <?= esc($regime['fat_percentage']) ?>%
                    </span>
                </div>

                <h1
                    style="font-family:'Playfair Display',serif; color:var(--el-black); font-size:2.5rem; margin-bottom:1.5rem;">
                    <?= esc($regime['name']) ?>
                </h1>

                <p class="text-muted" style="font-size:1.1rem; line-height:1.8;">
                    <?= nl2br(esc($regime['description'])) ?>
                </p>

                <div class="d-flex gap-4 mt-5 pt-3 border-top">
                    <div>
                        <small class="text-uppercase text-muted d-block mb-1"
                            style="letter-spacing:1px; font-size:0.75rem;">Durée du cycle</small>
                        <strong class="d-block"
                            style="color:var(--el-black); font-size:1.2rem;"><?= esc($regime['duration_days']) ?>
                            Jours</strong>
                    </div>
                    <div class="border-start ps-4">
                        <small class="text-uppercase text-muted d-block mb-1"
                            style="letter-spacing:1px; font-size:0.75rem;">Prix de base</small>
                        <strong class="d-block"
                            style="color:var(--el-gold-dark); font-size:1.2rem;"><?= number_format($regime['base_price'], 2) ?>
                            €</strong>
                    </div>
                </div>
            </div>

            <div
                class="col-md-4 d-flex flex-column justify-content-center align-items-end border-start mt-4 mt-md-0 pl-md-4">
                <div class="w-100 p-4" style="background:#FAFAFA;">
                    <h5 class="text-uppercase mb-4"
                        style="font-size:0.9rem; letter-spacing:1px; color:var(--el-black); border-bottom:1px solid #eee; padding-bottom:15px;">
                        Actions Administratives</h5>
                    <a href="<?= base_url('regimes/edit/' . $regime['id']) ?>"
                        class="btn w-100 rounded-0 py-2 mb-3 text-uppercase"
                        style="background:var(--el-black); color:#fff; letter-spacing: 1px; font-size: 0.85rem;">
                        <i class="fas fa-edit me-2"></i>Modifier le programme
                    </a>

                    <form action="<?= base_url('regimes/delete/' . $regime['id']) ?>" method="POST"
                        onsubmit="return confirm('Retirer définitivement ce programme du catalogue ?');">
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-0 py-2 text-uppercase"
                            style="letter-spacing: 1px; font-size: 0.85rem;">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>