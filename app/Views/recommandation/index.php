<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<div class="container mb-5">
    <div class="text-center mb-5">
        <h2 style="font-family:'Playfair Display',serif; color:var(--el-black);">Votre Bilan Nutritionnel</h2>
        <div style="width: 50px; height: 2px; background-color: var(--el-gold); margin: 10px auto;"></div>
        <p class="text-muted">Découvrez le programme sur-mesure adapté à votre organisme.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-0 p-5" style="background:#fff;">
                <form action="<?= base_url('recommandation/calculer') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <h5 class="text-uppercase mb-4" style="font-size:0.9rem; letter-spacing:1px; color:var(--el-gold-dark);">Données Biométriques</h5>
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label small text-muted text-uppercase">Taille (en cm) *</label>
                            <input type="number" name="taille" class="form-control rounded-0 border-dark py-2" required placeholder="Ex: 175" min="100" max="250">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Poids (en kg) *</label>
                            <input type="number" step="0.1" name="poids" class="form-control rounded-0 border-dark py-2" required placeholder="Ex: 70.5" min="30" max="300">
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label small text-muted text-uppercase">Genre</label>
                            <select name="genre" class="form-select rounded-0 border-dark py-2">
                                <option value="homme">Homme</option>
                                <option value="femme">Femme</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Objectif Principal *</label>
                            <select name="objectif" class="form-select rounded-0 border-dark py-2" required>
                                <option value="perte_poids">Réduire le poids</option>
                                <option value="prise_masse">Augmenter la masse musculaire</option>
                                <option value="maintien">Maintien & Équilibre (IMC idéal)</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-elegant py-3 px-5 text-uppercase w-100" style="letter-spacing: 1px; font-size: 0.9rem;">
                            Obtenir mon algorithme personnalisé
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>