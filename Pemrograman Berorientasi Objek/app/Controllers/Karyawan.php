<?php

namespace App\Controllers;

class Karyawan extends BaseController
{
    public function index() : string
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

            $M_karyawan = new \App\Models\M_karyawan;
            $data['data_karyawan'] = $M_karyawan->tampil_data();
            $data['nomor_otomatis'] = $M_karyawan->nomor_otomatis();
            return view('v_karyawan', $data);
        }else{
            $data['css_js'] = view('v_css_js');
            return view('v_login', $data);
        }
        
    }

function simpan(){
    $cek = session()->get('status_login');
    if (!empty($cek)) {
        $no_karyawan = $this->request->getPost('no_karyawan');
        $nama_karyawan = $this->request->getPost('nama_karyawan');
        $alamat = $this->request->getPost('alamat');
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $foto = $this->request->getFile('foto');
        if (!empty($foto->getFilename())) {
            $maxSize = 4 * 1024 * 1024;
            if ($foto->getSize() > $maxSize) {
                session()->setFlashdata('info', '<div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">
                        <i class="icon-remove"></i>
                        </button>
                        <strong>PENYIMPANAN DATA GAGAL<br></strong>
                        Ukuran foto yang diupload melebihi 4 MB
                    </div>');

                return redirect()->to('/Karyawan');
            }

            $typeFoto = $foto->getMimeType();
            if (!in_array($typeFoto, ['image/jpeg', 'image/jpg', 'image/png'])) {

                session()->setFlashdata('info', '
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="icon-remove"></i>
                        </button>
                        <strong>PENYIMPANAN DATA GAGAL<br></strong>
                        Type foto yang diupload bukan .jpeg, .jpg, atau .png
                    </div>
                ');

                return redirect()->to('/Karyawan');
            }

            

            $uploadPath = './assets/avatars/';
            $penamaan_acak = $foto->getRandomName();
            $foto->move($uploadPath, $penamaan_acak);
            $foto = $penamaan_acak;

            $M_karyawan = new \App\Models\M_karyawan;
            $M_karyawan->insert_data($no_karyawan, $nama_karyawan, $alamat, $hashedPassword, $foto);

            session()->setFlashdata('info', '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                    </button>
                    <i class="icon-ok"></i>
                    <strong>PENYIMPANAN DATA BERHASIL<br></strong>
                    Data sudah tersimpan
                </div>');

            return redirect()->to('/Karyawan');

        } else {

            $foto = 'avatar5.png';

            $M_karyawan = new \App\Models\M_karyawan;
            $M_karyawan->insert_data($no_karyawan, $nama_karyawan, $alamat, $hashedPassword, $foto);
            session()->setFlashdata('info', '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                    </button>
                    <i class="icon-ok"></i>
                    <strong>PENYIMPANAN DATA BERHASIL<br></strong>
                    Data sudah tersimpan
                </div>');
            return redirect()->to('/Karyawan');
        }

    } else {

        return redirect()->to('/login');
    }
}
function ubah(){
    $cek = session()->get('status_login');
    if (!empty($cek)) {
        $no_karyawan = $this->request->getPost('no_karyawan_edit');
        $nama_karyawan = $this->request->getPost('nama_karyawan_edit');
        $alamat = $this->request->getPost('alamat_edit');
        $password = $this->request->getPost('password_edit');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $foto = $this->request->getFile('foto');
        if (!empty($foto->getFilename())) {
            $maxSize = 4 * 1024 * 1024;
            if ($foto->getSize() > $maxSize) {
                session()->setFlashdata('info', '<div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">
                        <i class="icon-remove"></i>
                        </button>
                        <strong>PERUBAHAN DATA GAGAL<br></strong>
                        Ukuran foto yang diupload melebihi 4 MB
                    </div>');

                return redirect()->to('/Karyawan');
            }

            $typeFoto = $foto->getMimeType();
            if (!in_array($typeFoto, ['image/jpeg', 'image/jpg', 'image/png'])) {

                session()->setFlashdata('info', '
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="icon-remove"></i>
                        </button>
                        <strong>PERUBAHAN DATA GAGAL<br></strong>
                        Type foto yang diupload bukan .jpeg, .jpg, atau .png
                    </div>
                ');

                return redirect()->to('/Karyawan');
            }

            

            $uploadPath = './assets/avatars/';
            $penamaan_acak = $foto->getRandomName();
            $foto->move($uploadPath, $penamaan_acak);
            $foto = $penamaan_acak;
            $M_karyawan = new \App\Models\M_karyawan;
            $M_karyawan->update_data($no_karyawan,$nama_karyawan, $alamat, $password, $hashedPassword, $foto);
            session()->setFlashdata('info', '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                    </button>
                    <i class="icon-ok"></i>
                    <strong>PERUBAHAN DATA BERHASIL<br></strong>
                    Data sudah tersimpan
                </div>');

            return redirect()->to('/Karyawan');

        } else {
            $M_karyawan = new \App\Models\M_karyawan;
            $M_karyawan->update_data($no_karyawan, $nama_karyawan, $alamat, $password,  $hashedPassword, $foto->getFilename());
            session()->setFlashdata('info', '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                    </button>
                    <i class="icon-ok"></i>
                    <strong>PERUBAHAN DATA BERHASIL<br></strong>
                    Data sudah tersimpan
                </div>');
            return redirect()->to('/Karyawan');
        }

    } else {

        return redirect()->to('/login');
    }
}
function hapus(){
    $cek = session()->get('status_login');
    if (!empty($cek)) {
        $no_karyawan = $this->request->getUri()->getSegment(3);
        $M_karyawan = new \App\Models\M_karyawan;
        $M_karyawan->delete_data($no_karyawan);
        session()->setFlashdata('info', '<div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">
                                    <i class="icon-remove"></i>
                                    </button>
                                    <i class="icon-ok"></i>
                                    <strong>PENGHAPUSAN BERHASIL<br></strong>
                                    Data sudah dihapus pada database</div>');
        return redirect()->to('/Karyawan');

    } else {

        return redirect()->to('/login');
    }
}
function cetak(){
    $cek = session()->get('status_login');
    if (!empty($cek)) {
        require_once APPPATH . 'fpdf186/fpdf.php';
        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle("CETAK DAFTAR KARYAWAN");
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(260, 7, "DAFTAR KARYAWAN", 0, 1, 'C');
        $pdf->Cell(2, 7, '', 0, 1);
        $pdf->SetFillColor(27, 7, 67);
        $pdf->SetTextColor(255);
        $fill = true;
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'NO', 1, 0, 'C', $fill);
        $pdf->Cell(40, 6, 'NO KARYAWAN', 1, 0, 'C', $fill);
        $pdf->Cell(75, 6, 'NAMA KARYAWAN', 1, 0, 'C', $fill);
        $pdf->Cell(150, 6, 'ALAMAT', 1, 1, 'C', $fill);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(204, 229, 250);
        $pdf->SetTextColor(0);
        $fill2 = false;
        $M_karyawan = new \App\Models\M_karyawan;
        $data       = $M_karyawan->tampil_data();
        $no = 1;
        foreach ($data as $row) {
            $pdf->Cell(10, 6, $no, 1, 0, 'C', $fill2);
            $pdf->Cell(40, 6, $row->no_karyawan, 1, 0, 'C', $fill2);
            $pdf->Cell(75, 6, $row->nama_karyawan, 1, 0, 'L', $fill2);
            $pdf->Cell(150, 6, $row->alamat, 1, 1, 'L', $fill2);

            $fill2 = !$fill2;
            $no++;
        }

        $pdf->Output();
        exit;

    } else {

        return redirect()->to('/login');
    }
}

}