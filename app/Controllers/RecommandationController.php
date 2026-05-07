<?php
namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\ActiviteModel;

class RecommandationController extends BaseController
{
    public function index()
    {
        return view('recommandation/index');
    }

    public function calculer()
    {
        // Entrées de l'utilisateur (genre, taille en cm, poids en kg, objectif)
        $taille = $this->request->getPost('taille') / 100; // cm to m
        $poids = $this->request->getPost('poids');
        $objectif = $this->request->getPost('objectif'); // ex: 'perte', 'gain', 'imc_ideal'

        // 1. Calcul IMC
        $imc = $poids / ($taille * $taille);

        // 2. Moteur de recommandation (Mock de données pour tester l'UI sans la BDD)
        // $regimeModel = new RegimeModel();
        // $activiteModel = new ActiviteModel();

        // Trouver un régime qui correspond à l'objectif (ex: perdre du poids)
        // $regimeRecommande = $regimeModel->where('objectif_cible', $objectif)->first();
        
        // Trouver une activité sportive adaptée
        // $activiteRecommandee = $activiteModel->first(); // Logique plus poussée à intégrer selon le besoin

        // --- DEBUT DONNEES FACTICES (MOCK) ---
        $titreRegime = "";
        if ($objectif == 'perte') $titreRegime = "Keto Amincissant";
        elseif ($objectif == 'gain') $titreRegime = "Prise de Masse Protéinée";
        else $titreRegime = "Équilibre Parfait";

        $regimeRecommande = [
            'nom' => $titreRegime,
            'description' => 'Un programme riche et équilibré spécialement conçu pour votre objectif.',
            'prix_journalier' => 15500 // 15 500 Ar
        ];

        $activiteRecommandee = [
            'nom' => 'Cardio & Fitness (Niveau Adapté)',
            'description' => '3 séances d\'une heure par semaine pour accompagner votre métabolisme.'
        ];
        // --- FIN DONNEES FACTICES ---

        $data = [
            'imc' => round($imc, 2),
            'objectif' => $objectif,
            'regime' => $regimeRecommande,
            'activite' => $activiteRecommandee
        ];

        return view('recommandation/resultat', $data);
    }
}