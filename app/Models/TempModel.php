<?php

namespace App\Models;

use CodeIgniter\Model;

class TempModel extends Model
{
    protected $table = 'tempdiagnosis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','id_penyakit', 'list_gejala' ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    
    

    protected $skipValidation = false;

}