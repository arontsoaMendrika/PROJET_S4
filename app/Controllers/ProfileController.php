<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function index()
    {
        return redirect()->to('/profiles/form/1');
    }

    public function show($userId = null)
    {
        require_once ROOTPATH . '/includes/fonctions.php';

        if (!$userId) {
            $userId = 1; // ID par défaut
        }

        $profile = getUserProfile($userId);

        $data = [
            'profile' => $profile,
            'userId' => $userId
        ];

        return view('profiles/show', $data);
    }

    public function form($userId = null)
    {
        require_once ROOTPATH . '/includes/fonctions.php';

        if (!$userId) {
            $userId = 1; // ID par défaut
        }

        $profile = getUserProfile($userId);

        $data = [
            'profile' => $profile,
            'userId' => $userId
        ];

        return view('profiles/form', $data);
    }

    public function save()
    {
        require_once ROOTPATH . '/includes/fonctions.php';

        if (!$this->request->is('post')) {
            return redirect()->to('/profiles');
        }

        $data = [
            'user_id' => intval($this->request->getPost('user_id')),
            'height_cm' => floatval($this->request->getPost('height_cm')),
            'weight_kg' => floatval($this->request->getPost('weight_kg')),
            'age' => intval($this->request->getPost('age')),
            'gender' => sanitizeInput($this->request->getPost('gender')),
            'activity_level' => sanitizeInput($this->request->getPost('activity_level')),
            'objective' => sanitizeInput($this->request->getPost('objective')),
            'target_weight_kg' => !empty($this->request->getPost('target_weight_kg')) ?
                floatval($this->request->getPost('target_weight_kg')) : null,
            'medical_conditions' => sanitizeInput($this->request->getPost('medical_conditions')),
            'allergies' => sanitizeInput($this->request->getPost('allergies'))
        ];

        $errors = $this->validateProfileData($data);
        if (!empty($errors)) {
            return redirect()->to("/profiles/form/{$data['user_id']}")
                ->with('errors', $errors)
                ->with('old', $data);
        }

        $existingProfile = getUserProfile($data['user_id']);

        if ($existingProfile) {
            // Mise à jour (à implémenter)
            return redirect()->to("/profiles/show/{$data['user_id']}")
                ->with('error', 'Mise à jour du profil non implémentée');
        } else {
            // Création
            if (createUserProfile($data)) {
                return redirect()->to("/profiles/show/{$data['user_id']}")
                    ->with('success', 'Profil créé avec succès');
            } else {
                return redirect()->to("/profiles/form/{$data['user_id']}")
                    ->with('error', 'Erreur lors de la création du profil');
            }
        }
    }

    private function validateProfileData($data)
    {
        $errors = [];

        if ($data['height_cm'] <= 0) {
            $errors['height_cm'] = 'La taille doit être positive';
        }

        if ($data['weight_kg'] <= 0) {
            $errors['weight_kg'] = 'Le poids doit être positif';
        }

        if ($data['age'] <= 0 || $data['age'] > 120) {
            $errors['age'] = 'L\'âge doit être entre 1 et 120 ans';
        }

        if (!in_array($data['gender'], ['male', 'female', 'other'])) {
            $errors['gender'] = 'Genre invalide';
        }

        if (!in_array($data['activity_level'], ['sedentary', 'lightly_active', 'moderately_active', 'very_active', 'extremely_active'])) {
            $errors['activity_level'] = 'Niveau d\'activité invalide';
        }

        if (!in_array($data['objective'], ['weight_loss', 'muscle_gain', 'maintenance', 'endurance'])) {
            $errors['objective'] = 'Objectif invalide';
        }

        return $errors;
    }
}
