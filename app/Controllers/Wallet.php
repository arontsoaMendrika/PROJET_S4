<?php

namespace App\Controllers;

use App\Models\WalletModel;

class Wallet extends BaseController
{
    public function index() {
        $walletModel = new \App\Models\WalletModel();
        $userId = 1; // Toujours notre utilisateur test

        // ON SUPPRIME la ligne $resultat = ... 'REG001' ...
        
        // On ne fait QUE récupérer les infos actuelles de la base
        $data['wallet'] = $walletModel->chargerInfosWallet($userId);
        
        return view('wallet/index', $data);
    }

    public function recharger() {
        $walletModel = new \App\Models\WalletModel();
        $userId = 1; 

        $code = $this->request->getPost('code_recharge');

        if ($code) {
            $resultat = $walletModel->rechargerPortefeuille($userId, $code);
            
            // Optionnel : ajouter un message de succès
            if ($resultat === "SUCCES") {
                session()->setFlashdata('success', 'Votre compte a été crédité !');
            } else {
                session()->setFlashdata('error', 'Code invalide ou déjà utilisé.');
            }
        }

        return redirect()->to('/wallet');
    }
  public function devenirGold()
    {
        require_once(ROOTPATH . '/includes/fonctions.php');
        // On remplace temporairement la session par notre ID de test
        $userId = 1; 
        
        // Ton appel à la fonction dans fonctions.php
        $result = activerAbonnementGold($userId);

        if ($result === "SUCCES") {
            return redirect()->to('/wallet')->with('success', 'Félicitations ! Vous êtes maintenant membre GOLD. ✨');
        } elseif ($result === "SOLDE_INSUFFISANT") {
            return redirect()->to('/wallet')->with('error', 'Solde insuffisant (il vous faut 20 €).');
        } else {
            return redirect()->to('/wallet')->with('error', 'Une erreur est survenue.');
        }
    }
}