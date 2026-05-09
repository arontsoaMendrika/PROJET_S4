<?php
namespace App\Models;
use CodeIgniter\Model;

class MeasurementsModel extends Model
{
    protected $table = 'measurements';
    protected $allowedFields = ['user_id', 'measured_at', 'weight_kg', 'waist_cm', 'notes'];
    protected $useTimestamps = false;
}
