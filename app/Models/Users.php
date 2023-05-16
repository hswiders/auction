<?php 
namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $table = 'users'; 
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = ['first_name', 'email'];
    protected $useTimestamps = false;

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

}