<?php

namespace App\Models;

use CodeIgniter\Model;

class RuleModel extends Model
{
    protected $table = 'rule';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_penyakit', 'id_gejala','cf'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    
    protected $validationRules = [
        'id_penyakit' => 'required',
        'id_gejala' => 'required',
        'cf'=>'required'
    ];

    protected $skipValidation = false;
  
}
