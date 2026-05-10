<?php

namespace App\Models;

use CodeIgniter\Model;

// On inclut le fichier de fonctions pour pouvoir appeler getDBConnection() et les autres
require_once ROOTPATH . '/includes/fonctions.php';

class WalletModel extends Model
{
    protected $table            = 'user_wallet';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'balance', 'is_gold'];

  
    public function rechargerPortefeuille($userId, $code)
    {
    
        return validerEtAppliquerCode($userId, $code);
    }

   
    public function calculerPrix($userId, $prixBase)
    {
        // On appelle une fonction de ton fichier externe
        // par exemple : function getPrixGold($userId, $prixBase)
        return getPrixGold($userId, $prixBase);
    }

  
    public function chargerInfosWallet($userId)
    {
        $pdo = getDBConnection(); // Fonction déjà présente dans ton fonctions.php
        $stmt = $pdo->prepare("SELECT * FROM user_wallet WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }
}