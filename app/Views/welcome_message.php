<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>

<!-- Hero -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="min-height: 85vh; background: linear-gradient(rgba(26, 26, 26, 0.6), rgba(26, 26, 26, 0.8)), url('/assets/img/hero.jpg') center/cover no-repeat;">
    <div class="container text-white position-relative" style="z-index: 2;">
        <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display', serif; color: var(--el-gold);">Sculptez votre corps avec <span class="text-white">Excellence</span></h1>
        <p class="lead mb-5 mx-auto" style="max-width: 750px; font-weight: 300;">
            Une approche scientifique et luxueuse pour atteindre votre idéal morphologique, alliant haute gastronomie diététique et suivi sur-mesure.
        </p>
        <div class="mt-4">
            <a href="/recommandation" class="btn btn-elegant btn-lg px-5 py-3 rounded-0 text-uppercase" style="letter-spacing: 2px; font-size: 0.9rem;">
                Effectuer mon analyse morphologique
            </a>
        </div>
    </div>
</section>

<!-- Bandeau Programme -->
<section class="py-5" style="background-color: var(--el-gold);">
    <div class="container text-center">
        <h2 class="mb-0 text-dark" style="font-style: italic; font-family: 'Playfair Display', serif; font-size: 2rem;">L'équilibre parfait entre santé et raffinement.</h2>
    </div>
</section>

<!-- Fonctionnement -->
<section class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5 pb-3">
            <h2 class="display-5" style="color: var(--el-black); font-family: 'Playfair Display', serif;">L'Expérience Premium</h2>
            <div style="width: 60px; height: 2px; background-color: var(--el-gold); margin: 25px auto;"></div>
        </div>
        <div class="row g-5">
            <!-- 1 -->
            <div class="col-md-4 text-center">
                <div class="mb-4">
                    <img src="/assets/img/analyse_new.jpg" alt="Analyse" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--el-white);">
                </div>
                <h3 class="h4" style="font-family: 'Playfair Display', serif;">Analyse Scientifique</h3>
                <p class="text-muted mt-3 px-2">Calcul pointu de votre Indice de Masse Corporelle (IMC) et de vos besoins caloriques journaliers avec une précision clinique.</p>
            </div>
            <!-- 2 -->
            <div class="col-md-4 text-center">
                <div class="mb-4">
                    <img src="/assets/img/nutrition_new.jpg" alt="Nutrition" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--el-white);">
                </div>
                <h3 class="h4" style="font-family: 'Playfair Display', serif;">Haute Nutrition</h3>
                <p class="text-muted mt-3 px-2">Sélection de régimes conçus par des diététiciens étoilés, équilibrant parfaitement macronutriments et plaisirs gustatifs.</p>
            </div>
            <!-- 3 -->
            <div class="col-md-4 text-center">
                <div class="mb-4">
                    <img src="/assets/img/fitness_new.jpg" alt="Fitness" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--el-white);">
                </div>
                <h3 class="h4" style="font-family: 'Playfair Display', serif;">Accompagnement Physique</h3>
                <p class="text-muted mt-3 px-2">Un programme d'activités sportives adéquat afin de sublimer vos résultats, allant de la flexibilité douce à la prise de masse.</p>
            </div>
        </div>
    </div>
</section>

<!-- Zone Action Dev -->
<section class="py-5" style="background-color: var(--el-white); border-top: 1px solid #eaeaea;">
    <div class="container py-3">
        <div class="card border-0 bg-transparent">
            <div class="card-body p-4 text-center">
                <h5 class="text-muted mb-4" style="letter-spacing: 1px; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Administration du Système</h5>
                <a href="/regimes" class="btn btn-outline-dark px-4 py-2 me-2 mb-2 rounded-0 text-uppercase" style="letter-spacing: 1px; font-size: 0.8rem;">Base de données Régimes</a>
                <a href="/recommandation" class="btn btn-outline-dark px-4 py-2 mb-2 rounded-0 text-uppercase" style="letter-spacing: 1px; font-size: 0.8rem;">Outil de Recommandation</a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>