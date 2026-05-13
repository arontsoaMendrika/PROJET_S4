<?php
namespace App\Models;
use CodeIgniter\Model;
class UserModel extends Model
{
	protected $table = 'users';
	protected $allowedFields = ['email', 'password_hash', 'full_name', 'genre', 'role', 'profile_pic'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
}