<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunPelajaranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tahun_pelajaran';
    protected $primaryKey       = 'id_tahun';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_tahun','tahun','tp','smt','status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    function getData($where=[]){
        return $this->select('id_tahun,tahun,smt,tp,status')
                    ->where($where);
    }
}
