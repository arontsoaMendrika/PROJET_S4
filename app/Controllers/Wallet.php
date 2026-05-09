<?php

namespace App\Controllers;

use App\Models\WalletModel;

class Wallet extends BaseController
{
    public function index()
    {
        return view('wallet/index');
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
}