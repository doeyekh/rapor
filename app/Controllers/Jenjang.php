<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenjangModel;
use Ramsey\Uuid\Uuid;
use \Hermawan\DataTables\DataTable;

class Jenjang extends BaseController
{
    function __construct()
    {
        $this->jenjang = new JenjangModel();
    }
    public function index()
    {
        $data['title'] = 'Jenjang Level Pendidikan';
        $data['menu'] = 'jenjang';
        $data['sub'] = 'master';
        return view('admin/jenjang-level',$data);
    }
    public function edit(){
        if($this->request->isAJAX()){
            $data = $this->jenjang->where('id_jenjang',$this->request->getVar('id'))->first();
            echo json_encode($data);
        }
    }
    public function get(){
        if($this->request->isAJAX())
        {
            $builder = $this->jenjang->getData();
            return DataTable::of($builder)
                                ->addNumbering('nomor')
                                ->add('smt', function($row){
                                    return $row->total_smt .' Semester' ;
                                })
                                ->add('level', function($row){
                                    return $row->total_level .' Level Kelas' ;
                                })
                                ->add('kelas', function($row){
                                    return $row->kelas_awal .' - ' . $row->kelas_akhir ;
                                })
                                ->toJson(true);
        }
    }
    public function insertUpdate(){
        if($this->request->isAJAX()){
            $valid = $this->validate([
                'nama' =>[
                    'label' => 'Nama Jenjang',
                    'rules' => 'required|is_unique[jenjang.nama_jenjang]',
                    'errors' => [
                        'required' => '{field} Tidak boleh Kosong',
                        'is_unique' => '{field} Sudah Terdaftar'
                    ]
                    ],
                'smt' =>[
                    'label' => 'Semester',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh Kosong',
                    ]
                    ],
                'level' =>[
                    'label' => 'Level Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh Kosong',
                    ]
                    ],
                'awal' =>[
                    'label' => 'Kelas Awal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh Kosong',
                    ]
                    ],
                'akhir' =>[
                    'label' => 'Kelas Akhir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh Kosong',
                    ]
                    ],
            ]);

            if(!$valid){
                $msg = [
                    'error' => [
                        'nama' => $this->validation->getError('nama'),
                        'smt' => $this->validation->getError('smt'),
                        'level' => $this->validation->getError('level'),
                        'awal' => $this->validation->getError('awal'),
                        'akhir' => $this->validation->getError('akhir'),
                    ]
                ];
            }else{
                $uuid = Uuid::uuid4()->toString();
                $datainsert = [
                    'id_jenjang' => $uuid,
                    'nama_jenjang' => $this->request->getVar('nama'),
                    'total_smt' => $this->request->getVar('smt'),
                    'total_level' => $this->request->getVar('level'),
                    'kelas_awal' => $this->request->getVar('awal'),
                    'kelas_akhir' => $this->request->getVar('akhir'),
                ];  
                $dataupdate = [
                    'nama_jenjang' => $this->request->getVar('nama'),
                    'total_smt' => $this->request->getVar('smt'),
                    'total_level' => $this->request->getVar('level'),
                    'kelas_awal' => $this->request->getVar('awal'),
                    'kelas_akhir' => $this->request->getVar('akhir'),
                ]; 
                if($this->request->getVar('aksi') == 'insert'){
                    $this->jenjang->insert($datainsert);
                    $msg = [
                        'sukses' =>[
                            'head' => 'Horee',
                            'pesan' => 'Data Jenjang Berhasil Ditambahkan',
                            'icon' => 'success'
                        ]
                        ];
                }else{
                    $this->jenjang->update($this->request->getVar('idjenjang'),$dataupdate);
                    $msg = [
                        'sukses' =>[
                            'head' => 'Horee',
                            'pesan' => 'Data Jenjang Berhasil Diupdate',
                            'icon' => 'success'
                        ]
                        ];
                } 
            }
            echo json_encode($msg);
        }
    }
}
