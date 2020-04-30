<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'LogDiagnosis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','id_gejala', 'jawaban'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    
    

    protected $skipValidation = false;

}