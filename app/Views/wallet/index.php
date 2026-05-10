<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>

<div class="container mb-5">
    <div class="text-center mb-5">
        <h2 style="font-family:'Playfair Display',serif; color:var(--el-black);">Mon Portefeuille</h2>
        <div style="width: 50px; height: 2px; background-color: var(--el-gold); margin: 10px auto;"></div>
        <p class="text-muted">Gérez votre solde et votre abonnement exclusif.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            
            <div class="card border-0 shadow-sm rounded-0 p-5 mb-4 text-center" style="background:#fff; border-top: 4px solid var(--el-gold) !important;">
                <h5 class="text-uppercase mb-3" style="font-size:0.8rem; letter-spacing:2px; color:var(--el-gold-dark);">Budget Disponible</h5>
                <h1 style="font-family:'Playfair Display', serif; font-size:3.5rem; color:var(--el-black); margin:0;">
                    <?= number_format($wallet['balance'], 2, ',', ' ') ?> €
                </h1>
                
                <div class="mt-4">
                    <?php if ($wallet['is_gold']): ?>
                        <span class="badge py-2 px-3" style="background:var(--el-black); color:var(--el-gold); border: 1px solid var(--el-gold); border-radius:0; letter-spacing:1px;">
                           <i class="fas fa-crown me-2"></i> MEMBRE GOLD (Remise 15% active)
                        </span>
                    <?php else: ?>
                        <span class="badge py-2 px-3" style="background:#f8f9fa; color:#666; border-radius:0; letter-spacing:1px;">
                            MEMBRE STANDARD
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-0 p-4" style="background:#fff;">
                <form action="<?= base_url('wallet/recharger') ?>" method="POST">
                    <?= csrf_field() ?>
                    <h5 class="text-uppercase mb-4" style="font-size:0.85rem; letter-spacing:1px; color:var(--el-black);">Recharger mon compte</h5>
                    
                    <div class="mb-4">
                        <label class="form-label small text-muted text-uppercase">Code de recharge *</label>
                        <input type="text" name="code_recharge" class="form-control rounded-0 border-dark py-2" required placeholder="Ex: REG001" style="letter-spacing: 1px;">
                    </div>

                    <button type="submit" class="btn btn-elegant py-3 w-100 text-uppercase" style="letter-spacing: 1px; font-size: 0.9rem;">
                        Activer le code
                    </button>
                </form>
            </div>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success mt-4 rounded-0 border-0 border-start border-4" style="border-color: #28a745 !important;">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger mt-4 rounded-0 border-0 border-start border-4" style="border-color: #dc3545 !important;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection() ?>