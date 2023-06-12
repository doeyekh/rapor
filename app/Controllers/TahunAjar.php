<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TahunPelajaranModel;
use Ramsey\Uuid\Uuid;
use \Hermawan\DataTables\DataTable;

class TahunAjar extends BaseController
{
    function __construct(){
        $this->tahun = new TahunPelajaranModel();
    }
    public function index()
    {
        $data['title'] = 'Tahun Pelajaran';
        $data['menu'] = 'tahun';
        $data['sub'] = 'master';
        return view('admin/tahun-pelajaran',$data);
    }

    public function get(){
        if($this->request->isAJAX()){
            $builder = $this->tahun->getData();
            return DataTable::of($builder)->addNumbering('nomor')->toJson(true);
        }
    }
    public function update()
    {
        if($this->request->isAJAX()){
            if($this->db->table('tahun_pelajaran')->update(['status'=>'0'])){
                $this->tahun->update($this->request->getVar('id'),['status'=>'1']);
            }
        }
    }
    public function insert()
    {
        if($this->request->isAJAX()){
            $tahun = date('Y');
            if(date('m') > 6 ){
                $tp = date('Y') .' / '. date('Y') + 1;
                $smt = 'Ganjil';
            }else{
                $tp = date('Y') - 1 .' / '. date('Y');
                $smt = 'Genap';
            }
            if($this->tahun->where([
                'tahun' => $tahun,
                'tp' => $tp,
                'smt' => $smt
            ])->findAll()){
                $msg = [
                    'head' => 'Ops',
                    'pesan' => 'Tahun Pelajaran Sudah Terdaftar Anda Tidak Bisa Membuat Tahun Pelajaran Duplikat',
                    'icon' => 'error'
                ];
            }else{
                $uuid = Uuid::uuid4()->toString();
                if($this->tahun->insert([
                    'id_tahun' => $uuid,
                    'tahun' => $tahun,
                    'tp' => $tp,
                    'smt' => $smt,
                    'status' => '0'
                ])){
                    $msg = [
                        'head' => 'Hore',
                        'pesan' => 'Tahun Pelajaran Berhasil Dibuat',
                        'icon' => 'success'
                    ];
                }
            }
            echo json_encode($msg);
        }
    }
}
