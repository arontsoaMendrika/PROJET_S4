<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model
{
    protected $table            = 'user_wallet';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'balance', 'is_gold'];

    private function loadFonctions()
    {
        require_once ROOTPATH . '/includes/fonctions.php';
    }

    public function rechargerPortefeuille($userId, $code)
    {
        $this->loadFonctions();
        return validerEtAppliquerCode($userId, $code);
    }

    public function calculerPrix($userId, $prixBase)
    {
        $this->loadFonctions();
        return getPrixGold($userId, $prixBase);
    }

    public function chargerInfosWallet($userId)
    {
        $this->loadFonctions();
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("SELECT * FROM user_wallet WHERE user_id = ?");
        $stmt->execute([$userId]);
        $wallet = $stmt->fetch();
        
        if (!$wallet) {
            $insert = $pdo->prepare("INSERT INTO user_wallet (user_id, balance, is_gold) VALUES (?, 0.00, 0)");
            $insert->execute([$userId]);
            $wallet = ['user_id' => $userId, 'balance' => 0.00, 'is_gold' => 0];
        }
        
        return $wallet;
    }
}