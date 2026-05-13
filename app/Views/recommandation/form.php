<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<div class="container mb-5">
    <div class="text-center mb-5">
        <h2 style="font-family:'Playfair Display',serif; color:var(--el-black);">Analyse Morphologique</h2>
        <div style="width: 50px; height: 2px; background-color: var(--el-gold); margin: 10px auto;"></div>
        <p class="text-muted">Renseignez vos objectifs pour déterminer votre programme idéal.</p>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-5 mb-4 mb-md-0">
            <div class="card p-4 rounded-0 shadow-sm border-0" style="background:#fff;">
                <h4 class="mb-4" style="color:var(--el-gold-dark);">Vos Paramètres</h4>
                <form id="recommandationForm">
                    <div class="mb-3">
                        <label for="taille" class="form-label text-uppercase small text-muted">Taille (en cm) *</label>
                        <input type="number" class="form-control rounded-0 border-dark" id="taille" required value="175">
                    </div>
                    <div class="mb-3">
                        <label for="poids" class="form-label text-uppercase small text-muted">Poids (en kg) *</label>
                        <input type="number" class="form-control rounded-0 border-dark" id="poids" required value="75" step="0.1">
                    </div>
                    <div class="mb-4">
                        <label for="objectif" class="form-label text-uppercase small text-muted">Objectif visé *</label>
                        <select class="form-select rounded-0 border-dark" id="objectif" required>
                            <option value="perte_poids">Perte de poids optimale</option>
                            <option value="maintien" selected>Maintien & Équilibre</option>
                            <option value="prise_masse">Prise de masse musculaire</option>
                        </select>
                    </div>
                    <button type="button" onclick="calculerRecommandation()" class="btn btn-elegant w-100 py-3">
                        Générer l'algorithme de recommandation
                    </button>
                </form>
            </div>
        </div>
        
        <div class="col-md-7">
            <div class="card p-4 rounded-0 shadow-sm border-0 h-100" style="background:#FAFAFA;">
                <h4 class="mb-4" style="color:var(--el-black);">Résultat Scientifique</h4>
                <div id="results" class="d-flex align-items-center justify-content-center flex-column text-muted" style="min-height: 250px;">
                    <i class="fas fa-microscope text-muted mb-3" style="font-size: 3rem; opacity:0.3;"></i>
                    <p>Vos recommandations apparaîtront ici après analyse.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function calculerRecommandation() {
    const taille = document.getElementById('taille').value;
    const poids = document.getElementById('poids').value;
    const objectif = document.getElementById('objectif').value;
    
    if(!taille || !poids || !objectif) {
        alert("Veuillez remplir tous les champs.");
        return;
    }
    
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = `<div class="spinner-border text-secondary" role="status"><span class="visually-hidden">Calcul...</span></div>`;
    
    fetch("<?= base_url('recommandation/calculer') ?>", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: new URLSearchParams({
            'taille': taille,
            'poids': poids,
            'objectif': objectif
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            let html = `
                <div class="alert alert-secondary rounded-0 mb-4 border-0 border-start border-4" style="border-color: var(--el-gold) !important; background: #fff;">
                    <p class="mb-0">IMC Clinique calculé : <strong style="color:var(--el-gold-dark);">${data.imc.toFixed(2)}</strong> (${data.categorie})</p>
                </div>
                
                <h5 class="mb-3 text-uppercase" style="letter-spacing: 1px; color:var(--el-black); font-size:1rem;"><i class="fas fa-utensils me-2" style="color:var(--el-gold);"></i>Nutrition recommandée</h5>
                <div class="card border-0 mb-4 p-3 shadow-sm rounded-0" style="background:#fff; border-top:2px solid var(--el-gold) !important;">
                    <div class="d-flex justify-content-between">
                        <strong style="color:var(--el-black); font-family:'Playfair Display'; font-size: 1.2rem;">${data.regime.nom}</strong>
                        <span style="color:var(--el-gold-dark); font-weight:600;">${Math.round(data.regime.prix_journalier)} € <small class="text-muted fw-normal">/jour</small></span>    
                    </div>
                    <p class="text-muted mt-2 mb-0 small">${data.regime.description}</p>
                </div>

                <h5 class="mb-3 text-uppercase" style="letter-spacing: 1px; color:var(--el-black); font-size:1rem;"><i class="fas fa-dumbbell me-2" style="color:var(--el-gold);"></i>Activité requise</h5>
                <div class="card border-0 p-3 shadow-sm rounded-0" style="background:#fff;">
                    <strong style="color:var(--el-black); font-family:'Playfair Display'; font-size: 1.2rem;">${data.activite.nom}</strong>
                    <p class="text-muted mt-2 mb-0 small">${data.activite.description}</p>
                    <div class="mt-2 text-end">
                        <span class="badge" style="background:var(--el-dark-grey); color:var(--el-gold); font-weight:normal; border-radius:0;">Dépense moy. : ${data.activite.calories_bruulees} Kcal/h</span>
                    </div>
                </div>
            `;
            resultsDiv.innerHTML = html;
        } else {
            resultsDiv.innerHTML = '<p class="text-danger"><i class="fas fa-exclamation-triangle"></i> Erreur lors de l\\'algorithme...</p>';
        }
    })
    .catch(error => {
        resultsDiv.innerHTML = '<p class="text-danger">Impossible de joindre le serveur d\\'analyse.</p>';
    });
}
</script>
<?= $this->endSection() ?>
