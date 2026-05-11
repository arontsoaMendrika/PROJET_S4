<?php
namespace App\Models;

use CodeIgniter\Model;

class ActiviteModel extends Model
{
    protected $table            = 'activites';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nom', 'description', 'frequence_hebdo'];
    protected $useTimestamps    = true;
}