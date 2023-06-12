<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['menu'] = 'dashboard';
        $data['sub'] = '';
        return view('admin/dashboard',$data);
        // return view('welcome_message');
    }
}
