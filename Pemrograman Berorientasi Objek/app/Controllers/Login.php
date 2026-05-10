<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        $data['css_js'] = view('v_css_js');
        return view('v_Login', $data);
    }

    function proses(){
        if (isset ($_POST['btn_login'])) {
            $no_karyawan = $this->request->getPost('no_karyawan');
            $password = $this->request->getPost('password');
            $M_karyawan = new \App\Models\M_karyawan;
            $proses = $M_karyawan->cek_login($no_karyawan);
            if ($proses->getRow()->no_karyawan==$no_karyawan && password_verify($password, $proses->getRow()->password)){
                $data ['status_login'] = "True";
                $data ['no_karyawan'] = $proses->getRow()->no_karyawan;
                $data ['nama_karyawan'] = $proses->getRow()->nama_karyawan;
                $data ['alamat'] = $proses->getRow()->alamat;
                $data ['password'] = $proses->getRow()->password;
                $data ['foto'] = $proses->getRow()->foto;
                session()->set($data);
                return redirect()->to('/Dashboard');
            } else {
                if ($no_karyawan == "") {
                  session()->setFlashdata('info', '<div class="alert alert-info">
                                                      <button type="button" class="close" data-dismiss="alert">
                                                              <i class="icon-info"></i>
                                                       </button>

                                                       <strong>

                                                       OWW! ID masih kosong,silahkan diulang kembali!
                                                       <br>
                                                 </div>');
                return redirect()->to('/Login');
                }else if ($password == "") {
                  session()->setFlashdata('info', '<div class="alert alert-info">
                                                      <button type="button" class="close" data-dismiss="alert">
                                                              <i class="icon-info"></i>
                                                       </button>

                                                       <strong>

                                                       Ups! Password masih kosong,silahkan diulang kembali!
                                                       <br>
                                                 </div>');
                return redirect()->to('/Login');
                }else{
                    session()->setFlashdata('info', '<div class="alert alert-error">
                                                      <button type="button" class="close" data-dismiss="alert">
                                                              <i class="icon-remove"></i>
                                                       </button>

                                                       <strong>

                                                       Ups, Data (ID/Password) tidak tepat!.
                                                       <br>
                                                 </div>');
                return redirect()->to('/Login');
                }
                
            }
        }
    }

    function logout() {
        session()->destroy();
        return redirect()->to('/Login');
}

}
    