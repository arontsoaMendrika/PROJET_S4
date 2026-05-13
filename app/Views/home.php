<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>

<!-- Hero Section with Background Image -->
<section class="position-relative d-flex align-items-center justify-content-center" style="min-height: 80vh; background: linear-gradient(rgba(26, 26, 26, 0.7), rgba(26, 26, 26, 0.7)), url('/assets/img/hero.jpg') center/cover no-repeat;">
    <div class="container text-center text-white position-relative" style="z-index: 2;">
        <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display', serif; color: var(--el-gold);">Votre Programme VIP</h1>
        <p class="lead mb-5 mx-auto" style="max-width: 700px; font-weight: 300;">
            Découvrez votre régime personnalisé grâce à notre système de recommandation exclusif. Alliez haute gastronomie, bien-être et résultats sur-mesure.
        </p>
        <a href="/recommandation" class="btn btn-elegant btn-lg px-5 py-3 rounded-0 text-uppercase" style="letter-spacing: 2px;">
            <i class="fas fa-magic me-2"></i> Obtenir Ma Recommandation VIP
        </a>
    </div>
</section>

<!-- Stats Cards Section -->
<section class="container py-5 mt-4">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <img src="/assets/img/analyse_new.jpg" 
                     class="card-img-top rounded-circle mx-auto mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--el-gold);" alt="Plats Sains">
                <div class="card-body">
                    <h3 class="h4 mb-3" style="font-family: 'Playfair Display', serif; color: var(--el-black);">Nutrition Haute Couture</h3>
                    <p class="text-muted" style="font-size: 0.95rem;">Des programmes exclusifs et sur-mesure, conçus pour s'adapter à votre métabolisme unique.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <img src="/assets/img/nutrition_new.jpg" 
                     class="card-img-top rounded-circle mx-auto mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--el-gold);" alt="Ingrédients naturels">
                <div class="card-body">
                    <h3 class="h4 mb-3" style="font-family: 'Playfair Display', serif; color: var(--el-black);">Recommandation IA</h3>
                    <p class="text-muted" style="font-size: 0.95rem;">Une analyse intelligente de vos objectifs (perte de poids, prise de masse, maintien) pour cibler vos besoins exacts.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <img src="/assets/img/fitness_new.jpg" 
                     class="card-img-top rounded-circle mx-auto mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--el-gold);" alt="Assiette diététique">
                <div class="card-body">
                    <h3 class="h4 mb-3" style="font-family: 'Playfair Display', serif; color: var(--el-black);">Accompagnement Premium</h3>
                    <p class="text-muted" style="font-size: 0.95rem;">Accédez à des fonctionnalités réservées à nos membres VIP et suivez votre évolution avec style.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>