<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RegimeController extends BaseController
{
    public function index()
    {
        // Inclure nos fonctions personnalisées
        require_once ROOTPATH . '/includes/fonctions.php';

        $filters = [
            'query' => $this->request->getGet('query'),
            'type' => $this->request->getGet('type')
        ];

        // On utilise la fonction de filtre si au moins un paramètre existe, ou getAllRegimes() sinon
        if (!empty($filters['query']) || !empty($filters['type'])) {
            $regimes = filterRegimes($filters);
        } else {
            $regimes = getAllRegimes();
        }

        $types = getAllRegimeTypes();

        // Préparer les données pour la vue
        $data = [
            'regimes' => $regimes,
            'types' => $types
        ];

        return view('regimes/list', $data);
    }

    public function show($id = null)
    {
        require_once ROOTPATH . '/includes/fonctions.php';

        if (!$id) {
            return redirect()->to('/')->with('error', 'Régime non trouvé');
        }

        $regime = getRegimeById($id);
        if (!$regime) {
            return redirect()->to('/')->with('error', 'Régime non trouvé');
        }

        $pricingPlans = getPricingPlansByRegime($id);

        $data = [
            'regime' => $regime,
            'pricingPlans' => $pricingPlans
        ];

        return view('regimes/detail', $data);
    }

    public function create()
    {
        require_once ROOTPATH . '/includes/fonctions.php';

        $types = getAllRegimeTypes();

        $data = [
            'types' => $types
        ];

        return view('regimes/create', $data);
    }

    public function store()
    {
        require_once ROOTPATH . '/includes/fonctions.php';

        if (!$this->request->is('post')) {
            return redirect()->to('/regimes');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'regime_type_id' => intval($this->request->getPost('regime_type_id')),
            'duration_days' => intval($this->request->getPost('duration_days')),
            'base_price' => floatval($this->request->getPost('base_price')),
            'calories_per_day' => intval($this->request->getPost('calories_per_day')),
            'protein_percentage' => floatval($this->request->getPost('protein_percentage')),
            'carbs_percentage' => floatval($this->request->getPost('carbs_percentage')),
            'fat_percentage' => floatval($this->request->getPost('fat_percentage'))
        ];

        // Validation
        $errors = $this->validateRegimeData($data);
        if (!empty($errors)) {
            return redirect()->to('/regimes/create')
                ->with('errors', $errors)
                ->with('old', $data);
        }

        if (createRegime($data)) {
            return redirect()->to('/regimes')->with('success', 'Régime créé avec succès');
        } else {
            return redirect()->to('/regimes/create')
                ->with('error', 'Erreur lors de la création du régime');
        }
    }

    public function edit($id = null)
    {
        require_once ROOTPATH . '/includes/fonctions.php';

        if (!$id) {
            return redirect()->to('/regimes')->with('error', 'Régime non trouvé');
        }

        $regime = getRegimeById($id);
        if (!$regime) {
            return redirect()->to('/regimes')->with('error', 'Régime non trouvé');
        }

        $types = getAllRegimeTypes();

        $data = [
            'regime' => $regime,
            'types' => $types
        ];

        return view('regimes/edit', $data);
    }

    public function update($id = null)
    {
        require_once ROOTPATH . '/includes/fonctions.php';

        if (!$this->request->is('post')) {
            return redirect()->to('/regimes');
        }

        if (!$id) {
            return redirect()->to('/regimes')->with('error', 'Régime non trouvé');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'regime_type_id' => intval($this->request->getPost('regime_type_id')),
            'duration_days' => intval($this->request->getPost('duration_days')),
            'base_price' => floatval($this->request->getPost('base_price')),
            'calories_per_day' => intval($this->request->getPost('calories_per_day')),
            'protein_percentage' => floatval($this->request->getPost('protein_percentage')),
            'carbs_percentage' => floatval($this->request->getPost('carbs_percentage')),
            'fat_percentage' => floatval($this->request->getPost('fat_percentage'))
        ];

        $errors = $this->validateRegimeData($data);
        if (!empty($errors)) {
            return redirect()->to("/regimes/edit/{$id}")
                ->with('errors', $errors)
                ->with('old', $data);
        }

        if (updateRegime($id, $data)) {
            return redirect()->to('/regimes')->with('success', 'Régime mis à jour avec succès');
        } else {
            return redirect()->to("/regimes/edit/{$id}")
                ->with('error', 'Erreur lors de la mise à jour du régime');
        }
    }

    public function delete($id = null)
    {
        require_once ROOTPATH . '/includes/fonctions.php';

        if (!$id) {
            return redirect()->to('/regimes')->with('error', 'Régime non trouvé');
        }

        if (deleteRegime($id)) {
            return redirect()->to('/regimes')->with('success', 'Régime supprimé avec succès');
        } else {
            return redirect()->to('/regimes')->with('error', 'Erreur lors de la suppression du régime');
        }
    }

    private function validateRegimeData($data)
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Le nom est obligatoire';
        }

        if (empty($data['description'])) {
            $errors['description'] = 'La description est obligatoire';
        }

        if ($data['duration_days'] <= 0) {
            $errors['duration_days'] = 'La durée doit être positive';
        }

        if ($data['base_price'] <= 0) {
            $errors['base_price'] = 'Le prix doit être positif';
        }

        if ($data['calories_per_day'] <= 0) {
            $errors['calories_per_day'] = 'Les calories doivent être positives';
        }

        // Vérifier que le total des pourcentages = 100%
        $totalPercentage = $data['protein_percentage'] + $data['carbs_percentage'] + $data['fat_percentage'];
        if (abs($totalPercentage - 100) > 0.1) {
            $errors['macros'] = 'Le total des protéines, glucides et lipides doit être de 100%';
        }

        return $errors;
    }
}
