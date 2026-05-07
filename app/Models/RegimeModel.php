<?php
namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table            = 'regimes';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nom', 'description', 'prix_journalier', 'objectif_cible']; // objectif_cible ex: perte, gain, maintien
    protected $useTimestamps    = true;
}