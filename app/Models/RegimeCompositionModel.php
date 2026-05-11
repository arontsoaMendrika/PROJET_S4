<?php
namespace App\Models;

use CodeIgniter\Model;

class RegimeCompositionModel extends Model
{
    protected $table            = 'regime_compositions';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['regime_id', 'pourcentage_viande', 'pourcentage_poisson', 'pourcentage_volaille'];
    protected $useTimestamps    = true;
}