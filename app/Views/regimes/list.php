<?= $this->extend('layouts/elegance') ?>

<?= $this->section('content') ?>
<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h3 style="font-family:'Montserrat', sans-serif; font-weight:600; color:var(--el-dark-grey);">Base Nutritive
        </h3>
        <a href="<?= base_url('regimes/create') ?>" class="btn btn-elegant">
            <i class="fas fa-plus me-2"></i>Nouveau Programme
        </a>
    </div>

    <!-- Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success mt-4 rounded-0"
            style="border-color:var(--el-gold); color:var(--el-gold-dark); background:#fdfcf9;">
            <i class="fas fa-check-circle me-2"></i>
            <?= $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger mt-4 rounded-0">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <!-- Search and Filter -->
    <div class="card p-4 mb-5">
        <form id="searchForm" class="row g-3" method="GET" action="<?= base_url('regimes') ?>">
            <div class="col-md-4">
                <input type="text" name="query" class="form-control rounded-0" placeholder="Rechercher par mot-clé..."
                    value="<?= htmlspecialchars($_GET['query'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-4">
                <select name="type" class="form-select rounded-0">
                    <option value="">Tous les types</option>
                    <?php foreach ($types as $type): ?>
                        <option value="<?= $type['id']; ?>" <?= (isset($_GET['type']) && $_GET['type'] == $type['id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($type['name'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-elegant w-100">
                    <i class="fas fa-search me-2"></i>Filtrer
                </button>
            </div>
        </form>
    </div>

    <!-- Statistics -->
    <div class="row g-4 mb-5" id="stats-container">
        <div class="col-md-4">
            <div class="stat-card">
                <h3><?= count($regimes); ?></h3>
                <p>Total Programmes</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card border-dark">
                <h3 style="color:var(--el-gold-dark);">
                    <?= count(array_filter($regimes, fn($r) => $r['base_price'] <= 35)); ?>
                </h3>
                <p>Gammes Accessibles</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <h3><?= count(array_filter($regimes, fn($r) => $r['calories_per_day'] <= 1600)); ?></h3>
                <p>Détox & Hypocalorique</p>
            </div>
        </div>
    </div>

    <!-- List table -->
    <div class="table-responsive" id="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Programme & Descriptif</th>
                    <th class="text-center">Macronutriments</th>
                    <th class="text-center">Énergie</th>
                    <th class="text-center">Tarification</th>
                    <th class="text-center" style="min-width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($regimes as $regime): ?>
                    <tr>
                        <td>
                            <strong style="color:var(--el-black); font-size:1.1rem; display:block; margin-bottom:5px;">
                                <?= htmlspecialchars($regime['name'], ENT_QUOTES, 'UTF-8'); ?>
                            </strong>
                            <span class="text-muted small">
                                <?= htmlspecialchars($regime['description'], ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                            <div class="mt-2">
                                <span class="badge bg-light text-dark border border-secondary rounded-0">
                                    <?= htmlspecialchars($regime['type_name'], ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="small">
                                <span style="color:#C5A059; font-weight:bold;">P:</span>
                                <?= $regime['protein_percentage'] ?>%<br>
                                <span style="color:#C5A059; font-weight:bold;">G:</span>
                                <?= $regime['carbs_percentage'] ?>%<br>
                                <span style="color:#C5A059; font-weight:bold;">L:</span> <?= $regime['fat_percentage'] ?>%
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge"
                                style="background-color:var(--el-dark-grey); color:var(--el-gold); padding:8px 12px; font-weight:normal; letter-spacing:1px; border-radius:0;">
                                <?= $regime['calories_per_day'] ?> Kcal
                            </span>
                        </td>
                        <td class="text-center">
                            <strong class="fs-5"><?= number_format($regime['base_price'], 2, ',', ' ') ?> €</strong>
                            <div class="text-muted small">Base <?= $regime['duration_days'] ?> jours</div>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="<?= base_url('regimes/show/' . $regime['id']) ?>"
                                    class="btn btn-sm btn-outline-elegant" title="Détails"><i class="fas fa-eye"></i></a>
                                <a href="<?= base_url('regimes/edit/' . $regime['id']) ?>"
                                    class="btn btn-sm btn-outline-elegant border-start-0" title="Modifier"><i
                                        class="fas fa-edit"></i></a>
                                <a href="<?= base_url('regimes/delete/' . $regime['id']) ?>" class="btn btn-sm btn-dark"
                                    title="Supprimer"
                                    onclick="return confirm('Confirmer la suppression de cette gamme ?');"><i
                                        class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($regimes)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            Aucun programme n'a été trouvé.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchForm = document.getElementById("searchForm");
        const queryInput = searchForm.querySelector("input[name='query']");
        const typeSelect = searchForm.querySelector("select[name='type']");
        const tableContainer = document.getElementById("table-container");
        const statsContainer = document.getElementById("stats-container");

        function fetchResults() {
            const url = new URL(searchForm.action);
            url.searchParams.set("query", queryInput.value);
            url.searchParams.set("type", typeSelect.value);

            fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, "text/html");
                    const newTable = doc.getElementById("table-container");
                    const newStats = doc.getElementById("stats-container");
                    if (newTable) {
                        tableContainer.innerHTML = newTable.innerHTML;
                    }
                    if (newStats) {
                        statsContainer.innerHTML = newStats.innerHTML;
                    }
                })
                .catch(error => console.error("Error fetching data:", error));
        }

        queryInput.addEventListener("keyup", fetchResults);
        typeSelect.addEventListener("change", fetchResults);
        searchForm.addEventListener("submit", function (e) {
            e.preventDefault();
            fetchResults();
        });
    });
</script>
<?= $this->endSection() ?>
