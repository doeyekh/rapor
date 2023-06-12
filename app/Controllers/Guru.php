<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Guru extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Guru / Tenaga Pendidik',
            'menu' => 'guru',
            'sub' => 'master'
        ];
        return view('admin/guru',$data);
    }
}
