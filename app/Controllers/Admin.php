<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $data['totalUsers'] = $db->table('users')->countAll();
        
        $query = $db->query("SELECT SUM(amount) as total FROM recharge_codes WHERE is_used = 1");
        $data['totalRevenue'] = $query->getRow()->total ?? 0;

        $data['goldUsers'] = $db->table('user_wallet')->where('is_gold', 1)->countAllResults();

      
        $data['recentTransactions'] = $db->table('transactions')
            ->orderBy('created_at', 'DESC') 
            ->limit(5)
            ->get()->getResultArray();
            
        $data['goalStats'] = $db->table('users')
            ->select('goal, COUNT(*) as nb')
            ->groupBy('goal')
            ->get()->getResultArray();


        $data['availableCodes'] = $db->table('recharge_codes')
            ->where('is_used', 0)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/dashboard', $data);
    }

    
    public function generateCodes()
    {
        $db = \Config\Database::connect();
        
        $amount = $this->request->getPost('amount');
        $count = (int) $this->request->getPost('count'); // Nombre de codes à créer

        $query = $db->query("SELECT MAX(code_value) as last_code FROM recharge_codes");
        $lastCodeValue = $query->getRow()->last_code;
        
        $lastNumber = ($lastCodeValue) ? (int) substr($lastCodeValue, 3) : 0;

        for ($i = 1; $i <= $count; $i++) {
            $currentNumber = $lastNumber + $i;
            
        
            $newCode = 'REG' . str_pad($currentNumber, 3, '0', STR_PAD_LEFT);

            $db->table('recharge_codes')->insert([
                'code_value' => $newCode,
                'amount'     => $amount,
                'is_used'    => 0
            ]);
        }

        return redirect()->to('/admin')->with('message', $count . ' codes générés !');
    }
}