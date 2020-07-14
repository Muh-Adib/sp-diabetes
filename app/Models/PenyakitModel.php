<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyakitModel extends Model
{
    protected $table = 'penyakit';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','kode', 'nama' ,'penyebab','solusi'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    
    protected $validationRules = [
        'kode' => 'required',
        'nama' => 'required',
    ];

    protected $skipValidation = false;
    
    
  
}
