<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MeasurementsModel;

class Auth extends BaseController
{
    public function register()
    {
        helper('url');
        $userModel = new UserModel();

        if ($this->request->is('post')) {
            $nom = trim($this->request->getPost('nom'));
            $prenom = trim($this->request->getPost('prenom'));
            $email = trim($this->request->getPost('email'));
            $password = $this->request->getPost('password');

            if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
                session()->setFlashdata('error', 'Tous les champs obligatoires doivent être remplis.');
                return redirect()->back()->withInput();
            }

            if ($userModel->where('email', $email)->first()) {
                session()->setFlashdata('error', 'Un compte avec cet email existe déjà.');
                return redirect()->back()->withInput();
            }

            $userData = [
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'full_name' => $nom . ' ' . $prenom,
                'role' => 'user',
            ];

            $userModel->insert($userData);
            $id = $userModel->getInsertID();

            session()->set('user_id', $id);
            session()->set('user_name', $userData['full_name']);

            return redirect()->to('/profile');
        }

        return view('inscription');
    }

    public function registerHealth()
    {
        helper('url');
        $measureModel = new MeasurementsModel();
        $userModel = new UserModel();

        if ($this->request->is('post')) {
            $taille = (float) $this->request->getPost('taille');
            $poids = (float) $this->request->getPost('poids');
            $activite = $this->request->getPost('activite');

            $userId = session()->get('user_id');
            if (!$userId) {
                session()->setFlashdata('error', 'Vous devez être connecté pour enregistrer vos données santé.');
                return redirect()->to('/login');
            }

            if ($taille <= 0 || $poids <= 0) {
                session()->setFlashdata('error', 'Taille et poids doivent être valides.');
                return redirect()->back()->withInput();
            }

            $imc = $poids / (($taille/100)*($taille/100));

            $measureModel->insert([
                'user_id' => $userId,
                'weight_kg' => $poids,
                'waist_cm' => null,
                'notes' => 'IMC: ' . round($imc,1) . ' / Activite: ' . $activite,
            ]);

            session()->setFlashdata('success', 'Données santé enregistrées.');
            return redirect()->to('/profile');
        }

        return view('inscription_sante');
    }

    public function login()
    {
        helper('url');
        $userModel = new UserModel();

        if ($this->request->is('post')) {
            $email = trim($this->request->getPost('email'));
            $password = $this->request->getPost('password');

            $user = $userModel->where('email', $email)->first();
            if (!$user || !password_verify($password, $user['password_hash'])) {
                session()->setFlashdata('error', 'Email ou mot de passe invalide.');
                return redirect()->back()->withInput();
            }

            session()->set('user_id', $user['id']);
            session()->set('user_name', $user['full_name'] ?? $user['email']);
            return redirect()->to('/profile');
        }

        return view('login');
    }

    public function forgotPassword()
    {
        helper('url');
        $userModel = new UserModel();

        if ($this->request->is('post')) {
            $email = trim($this->request->getPost('email'));
            $user = $userModel->where('email', $email)->first();
            if ($user) {
                session()->setFlashdata('success', 'Si cet email existe, un lien de réinitialisation a été envoyé.');
            } else {
                session()->setFlashdata('success', 'Si cet email existe, un lien de réinitialisation a été envoyé.');
            }
            return redirect()->to('/login');
        }

        return view('forgot_password');
    }

    public function profile()
    {
        $userModel = new UserModel();
        $measureModel = new MeasurementsModel();

        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $user = $userModel->find($userId);
        $lastMeasures = $measureModel->where('user_id', $userId)->orderBy('measured_at', 'DESC')->first();

        $data = [
            'user' => $user,
            'measures' => $lastMeasures,
            'flash' => [
                'error' => session()->getFlashdata('error'),
                'success' => session()->getFlashdata('success'),
            ],
        ];

        return view('profile', $data);
    }
}
