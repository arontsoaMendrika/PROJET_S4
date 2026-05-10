<?php

namespace App\Controllers;

use App\Models\WalletModel;

class Wallet extends BaseController
{
  public function index() {
    $walletModel = new \App\Models\WalletModel();
    

    $testWallet = $walletModel->chargerInfosWallet(1);
    
    
    dd($testWallet); 
}

    public function recharger()
    {
        $walletModel = new WalletModel();
        
        $code = $this->request->getPost('code_recharge');
        $userId = session()->get('user_id'); 

        $status = $walletModel->rechargerPortefeuille($userId, $code);

        if ($status === 'SUCCES') {
            return redirect()->to('/wallet')->with('success', 'Votre compte a été crédité !');
        } else {
            return redirect()->to('/wallet')->with('error', 'Code invalide ou déjà utilisé.');
        }
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