<?php

namespace App\Controllers;

use App\Models\WalletModel;

class Wallet extends BaseController
{
    public function index() {
        $walletModel = new \App\Models\WalletModel();
        $userId = 1;

        // ÉTAPE 2 : On teste la recharge avec le code que tu as créé en base
        $resultat = $walletModel->rechargerPortefeuille($userId, 'REG001');
        
        // On récupère les infos mises à jour pour l'affichage
        $data['wallet'] = $walletModel->chargerInfosWallet($userId);
        
        return view('wallet/index', $data);
    }
public function recharger() {
    $walletModel = new \App\Models\WalletModel();
    $userId = 1; // On utilise toujours notre utilisateur de test

    // 1. On récupère le code écrit dans l'input "code_recharge"
    $code = $this->request->getPost('code_recharge');

    // 2. On lance la recharge
    $resultat = $walletModel->rechargerPortefeuille($userId, $code);

    // 3. On redirige vers la page d'accueil du portefeuille pour voir le nouveau solde
    return redirect()->to('/wallet');
}
    public function devenirGold()
    {
        $userId = session()->get('user_id');
        
        $result = activerAbonnementGold($userId);

        if ($result === "SUCCES") {
            return redirect()->to('/wallet')->with('success', 'Félicitations ! Vous êtes maintenant membre GOLD. ✨');
        } elseif ($result === "SOLDE_INSUFFISANT") {
            return redirect()->to('/wallet')->with('error', 'Solde insuffisant pour l\'abonnement Gold.');
        } else {
            return redirect()->to('/wallet')->with('error', 'Une erreur est survenue.');
        }
    }
}