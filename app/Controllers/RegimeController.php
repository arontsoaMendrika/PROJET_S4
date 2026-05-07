<?php
namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\RegimeCompositionModel;

class RegimeController extends BaseController
{
    private $regimeModel;
    private $compoModel;

    public function __construct()
    {
        $this->regimeModel = new RegimeModel();
        $this->compoModel = new RegimeCompositionModel();
    }

    public function index()
    {
        $data['regimes'] = $this->regimeModel->findAll();
        // Return view
        return view('regimes/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $regimeData = [
                'nom' => $this->request->getPost('nom'),
                'description' => $this->request->getPost('description'),
                'prix_journalier' => $this->request->getPost('prix_journalier'),
                'objectif_cible' => $this->request->getPost('objectif_cible')
            ];
            $this->regimeModel->insert($regimeData);
            $regimeId = $this->regimeModel->getInsertID();

            $compoData = [
                'regime_id' => $regimeId,
                'pourcentage_viande' => $this->request->getPost('viande'),
                'pourcentage_poisson' => $this->request->getPost('poisson'),
                'pourcentage_volaille' => $this->request->getPost('volaille')
            ];
            $this->compoModel->insert($compoData);
            return redirect()->to('/regimes');
        }
        return view('regimes/create');
    }

    public function edit($id)
    {
        // CRUD: update function
    }

    public function delete($id)
    {
        $this->regimeModel->delete($id);
        return redirect()->to('/regimes');
    }
}