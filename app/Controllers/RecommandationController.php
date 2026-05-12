<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RecommandationController extends BaseController
{
    public function index()
    {
        return view('recommandation/index');
    }
    
    public function form()
    {
        require_once ROOTPATH . '/includes/fonctions.php';
        
        $activities = getAllActivities();
        
        $data = [
            'activities' => $activities
        ];
        
        return view('recommandation/form', $data);
    }

    public function calculer()
    {
        require_once ROOTPATH . '/includes/fonctions.php';

        // Entrées de l'utilisateur (taille en cm, poids en kg, objectif)
        $tailleCm = $this->request->getPost('taille');
        $tailleM = $tailleCm / 100; // cm to m
        $poids = $this->request->getPost('poids');
        $objectif = $this->request->getPost('objectif'); // 'perte_poids', 'prise_masse', 'maintien'

        // 1. Calcul IMC
        $imc = calculateBMI($poids, $tailleCm);
        $categorieImc = getBMICategory($imc);

        // 2. Moteur de recommandation basé sur la base de données
        $regimes = getAllRegimes();
        $activities = getAllActivities();

        $regimeRecommande = null;
        $activiteRecommandee = null;

        // Logique de choix du régime selon l'objectif et l'IMC
        if ($objectif == 'perte_poids') {
            $regimeRecommande = array_filter($regimes, fn($r) => strpos(strtolower($r['name']), 'keto') !== false || $r['calories_per_day'] <= 1600);
            $activiteRecommandee = array_filter($activities, fn($a) => in_array($a['category'], ['cardio', 'strength']) && $a['calories_burned_per_hour'] >= 300);
        } elseif ($objectif == 'prise_masse') {
            $regimeRecommande = array_filter($regimes, fn($r) => $r['protein_percentage'] >= 20 || $r['calories_per_day'] >= 2000);
            $activiteRecommandee = array_filter($activities, fn($a) => strpos(strtolower($a['category']), 'strength') !== false || strpos(strtolower($a['name']), 'musculation') !== false);
        } else {
            // Maintien ou cas par défaut
            if ($categorieImc == 'Surpoids' || $categorieImc == 'Obésité') {
                // S'il veut maintenir mais qu'il est en surpoids, on oriente discrètement vers un léger déficit (Méditerranéen)
                $regimeRecommande = array_filter($regimes, fn($r) => $r['calories_per_day'] >= 1600 && $r['calories_per_day'] <= 1800);
            } elseif ($categorieImc == 'Insuffisance pondérale') {
                $regimeRecommande = array_filter($regimes, fn($r) => $r['calories_per_day'] >= 2000);
            } else {
                $regimeRecommande = array_filter($regimes, fn($r) => strpos(strtolower($r['name']), 'balance') !== false || $r['calories_per_day'] == 1800);
            }
            $activiteRecommandee = array_filter($activities, fn($a) => $a['category'] == 'flexibility' || $a['intensity_level'] == 'low');
        }

        // On prend le premier match ou un par défaut
        $regimeRecommande = !empty($regimeRecommande) ? array_values($regimeRecommande)[0] : $regimes[0];
        $activiteRecommandee = !empty($activiteRecommandee) ? array_values($activiteRecommandee)[0] : $activities[0];
        
        $pricing = getPricingPlansByRegime($regimeRecommande['id']);

        if ($this->request->isAJAX()) { // Traitement de l'appel AJAX
            return $this->response->setJSON([
                'status' => 'success',
                'imc' => $imc,
                'categorie' => $categorieImc,
                'regime' => [
                    'nom' => $regimeRecommande['name'],
                    'description' => $regimeRecommande['description'],
                    'prix_journalier' => $regimeRecommande['base_price'],
                    'tarifs' => $pricing
                ],
                'activite' => [
                    'nom' => $activiteRecommandee['name'],
                    'description' => $activiteRecommandee['description'],
                    'calories_bruulees' => $activiteRecommandee['calories_burned_per_hour']
                ]
            ]);
        }

        $data = [
            'imc' => $imc,
            'categorie' => $categorieImc,
            'objectif' => $objectif,
            'regime' => $regimeRecommande,
            'activite' => $activiteRecommandee,
            'tarifs' => $pricing
        ];

        return view('recommandation/resultat', $data);
    }

 public function exportPDF() 
    {
        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $user = $db->table('users')->where('id', $userId)->get()->getRowArray();
        $profile = $db->table('user_profiles')->where('user_id', $userId)->get()->getRowArray();

        if (!$profile) {
            return redirect()->back()->with('error', 'Données manquantes');
        }

        $data = [
            'user' => $user,
            'profile' => $profile,
            'imc' => $profile['weight'] / (($profile['height']/100) ** 2),
            'is_print' => true 
        ];

        return view('recommandations/report_pdf', $data);
    }
}
