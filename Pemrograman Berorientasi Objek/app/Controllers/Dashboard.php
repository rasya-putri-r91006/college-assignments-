<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $cek = session()->get('status_login');

        if (!empty($cek)) {
            $data['no_karyawan']   = session()->get('no_karyawan');
            $data['nama_karyawan'] = session()->get('nama_karyawan');
            $data['alamat'] = session()->get('alamat');
            $data['password'] = session()->get('password');
            $data['foto'] = session()->get('foto');

            $data['css_js'] = view('v_css_js');
            $data['navbar'] = view('v_navbar', $data);
            $data['sidebar'] = view('v_sidebar');

            return view('v_dashboard', $data);
        } 
        
        $data['css_js'] = view('v_css_js');
        return view('v_login', $data);
    }
}
