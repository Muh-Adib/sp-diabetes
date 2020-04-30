<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosisModel extends Model
{
    protected $table = 'diagnosis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','id_penyakit', 'list_gejala' ,'cf'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    
    
    

}