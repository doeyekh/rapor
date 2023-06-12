<?php

namespace App\Models;

use CodeIgniter\Model;

class JenjangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jenjang';
    protected $primaryKey       = 'id_jenjang';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_jenjang','nama_jenjang','total_smt','total_level','kelas_awal','kelas_akhir'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getData($id=[]){
        return $this->select('id_jenjang,nama_jenjang,total_smt,total_level,kelas_awal,kelas_akhir')
                    ->where($id)
                    ->orderBy('kelas_awal','ASC');
    }
}
