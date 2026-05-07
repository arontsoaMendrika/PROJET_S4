<?= view('templates/header') ?>

<div class="chic-card">
    <h2 style="text-align: center; color: var(--accent); margin-bottom: 50px;">Votre Profil & Recommandation</h2>
    
    <form action="/recommandation/calculer" method="POST">
        <?= csrf_field() ?>
        <div class="row" style="display: flex; gap: 30px;">
            <div class="col" style="flex: 1;">
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <select name="genre" id="genre" class="form-control" required>
                        <option value="" disabled selected>Sélectionnez...</option>
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row" style="display: flex; gap: 30px;">
            <div class="col" style="flex: 1;">
                <div class="form-group">
                    <label for="taille">Taille (cm)</label>
                    <input type="number" name="taille" id="taille" class="form-control" placeholder="170" required min="100" max="250">
                </div>
            </div>
            <div class="col" style="flex: 1;">
                <div class="form-group">
                    <label for="poids">Poids (kg)</label>
                    <!-- Dans la table schema.sql `measurements` => `weight_kg` -->
                    <input type="number" name="poids" id="poids" step="0.1" class="form-control" placeholder="65.5" required min="30" max="300">
                </div>
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label for="objectif">Votre Objectif de Régime</label>
            <select name="objectif" id="objectif" class="form-control" required>
                <option value="" disabled selected>Que souhaitez-vous accomplir ?</option>
                <option value="perte">Réduire le poids</option>
                <option value="gain">Augmenter le poids</option>
                <option value="imc_ideal">Atteindre / Conserver l'IMC idéal</option>
            </select>
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <button type="submit" class="btn-chic">Obtenir mon programme personnalisé</button>
        </div>
    </form>
</div>

<?= view('templates/footer') ?>