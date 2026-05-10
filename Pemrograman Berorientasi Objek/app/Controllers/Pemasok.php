<?php

namespace App\Controllers;

class Pemasok extends BaseController
{
    public function index() : string
    {
        $cek = session()->get('status_login');
        if (!empty($cek)) {
            $data['no_karyawan']   = session()->get('no_karyawan');
            $data['nama_karyawan'] = session()->get('nama_karyawan');
            $data['alamat'] = session()->get('alamat');
            $data['no_telp'] = session()->get('no_telp');
            $data['foto'] = session()->get('foto');

            $data['css_js'] = view('v_css_js');
            $data['navbar'] = view('v_navbar', $data);
            $data['sidebar'] = view('v_sidebar');

            $M_pemasok = new \App\Models\M_pemasok;
            $data['data_pemasok'] = $M_pemasok->tampil_data();
            $data['nomor_otomatis'] = $M_pemasok->nomor_otomatis();
            return view('v_pemasok', $data);
        }else{
            $data['css_js'] = view('v_css_js');
            return view('v_login', $data);
        }
        
    }

function simpan(){
    $cek = session()->get('status_login');
    if (!empty($cek)) {
        $no_pemasok = $this->request->getPost('no_pemasok');
        $nama_pemasok = $this->request->getPost('nama_pemasok');
        $alamat = $this->request->getPost('alamat');
        $no_telp = $this->request->getPost('no_telp');
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

                return redirect()->to('/Pemasok');
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

                return redirect()->to('/Pemasok');
            }

            

            $uploadPath = './assets/avatars/';
            $penamaan_acak = $foto->getRandomName();
            $foto->move($uploadPath, $penamaan_acak);
            $foto = $penamaan_acak;

            $M_pemasok = new \App\Models\M_pemasok;
            $M_pemasok->insert_data($no_pemasok, $nama_pemasok, $alamat, $no_telp, $foto);

            session()->setFlashdata('info', '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                    </button>
                    <i class="icon-ok"></i>
                    <strong>PENYIMPANAN DATA BERHASIL<br></strong>
                    Data sudah tersimpan
                </div>');

            return redirect()->to('/Pemasok');

        } else {

            $foto = 'avatar5.png';

            $M_pemasok = new \App\Models\M_pemasok;
            $M_pemasok->insert_data($no_pemasok, $nama_pemasok, $alamat, $no_telp, $foto);
            session()->setFlashdata('info', '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                    </button>
                    <i class="icon-ok"></i>
                    <strong>PENYIMPANAN DATA BERHASIL<br></strong>
                    Data sudah tersimpan
                </div>');
            return redirect()->to('/Pemasok');
        }

    } else {

        return redirect()->to('/login');
    }
}
function ubah(){
    $cek = session()->get('status_login');
    if (!empty($cek)) {
        $no_pemasok = $this->request->getPost('no_pemasok_edit');
        $nama_pemasok = $this->request->getPost('nama_pemasok_edit');
        $alamat = $this->request->getPost('alamat_edit');
        $no_telp = $this->request->getPost('no_telp_edit');
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

                return redirect()->to('/Pemasok');
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

                return redirect()->to('/Pemasok');
            }

            

            $uploadPath = './assets/avatars/';
            $penamaan_acak = $foto->getRandomName();
            $foto->move($uploadPath, $penamaan_acak);
            $foto = $penamaan_acak;
            $M_pemasok = new \App\Models\M_pemasok;
            $M_pemasok->update_data($no_pemasok,$nama_pemasok, $alamat, $no_telp, $foto);
            session()->setFlashdata('info', '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                    </button>
                    <i class="icon-ok"></i>
                    <strong>PERUBAHAN DATA BERHASIL<br></strong>
                    Data sudah tersimpan
                </div>');

            return redirect()->to('/Pemasok');

        } else {
            $M_pemasok = new \App\Models\M_pemasok;
            $M_pemasok->update_data($no_pemasok, $nama_pemasok, $alamat, $no_telp, $foto->getFilename());
            session()->setFlashdata('info', '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                    </button>
                    <i class="icon-ok"></i>
                    <strong>PERUBAHAN DATA BERHASIL<br></strong>
                    Data sudah tersimpan
                </div>');
            return redirect()->to('/Pemasok');
        }

    } else {

        return redirect()->to('/login');
    }
}
function hapus(){
    $cek = session()->get('status_login');
    if (!empty($cek)) {
        $no_pemasok = $this->request->getUri()->getSegment(3);
        $M_pemasok = new \App\Models\M_pemasok;
        $M_pemasok->delete_data($no_pemasok);
        session()->setFlashdata('info', '<div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">
                                    <i class="icon-remove"></i>
                                    </button>
                                    <i class="icon-ok"></i>
                                    <strong>PENGHAPUSAN BERHASIL<br></strong>
                                    Data sudah dihapus pada database</div>');
        return redirect()->to('/Pemasok');

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
        $pdf->SetTitle("CETAK DAFTAR PEMASOK");
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(260, 7, "DAFTAR PEMASOK", 0, 1, 'C');
        $pdf->Cell(2, 7, '', 0, 1);
        $pdf->SetFillColor(27, 7, 67);
        $pdf->SetTextColor(255);
        $fill = true;
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'NO', 1, 0, 'C', $fill);
        $pdf->Cell(40, 6, 'NO PEMASOK', 1, 0, 'C', $fill);
        $pdf->Cell(75, 6, 'NAMA PEMASOK', 1, 0, 'C', $fill);
         $pdf->Cell(50, 6, 'NO TELP', 1, 0, 'C', $fill);
        $pdf->Cell(100, 6, 'ALAMAT', 1, 1, 'C', $fill);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(204, 229, 250);
        $pdf->SetTextColor(0);
        $fill2 = false;
        $M_pemasok = new \App\Models\M_pemasok;
        $data       = $M_pemasok->tampil_data();
        $no = 1;
        foreach ($data as $row) {
            $pdf->Cell(10, 6, $no, 1, 0, 'C', $fill2);
            $pdf->Cell(40, 6, $row->no_pemasok, 1, 0, 'C', $fill2);
            $pdf->Cell(75, 6, $row->nama_pemasok, 1, 0, 'L', $fill2);
            $pdf->Cell(50, 6, $row->no_telp, 1, 0, 'L', $fill2);
            $pdf->Cell(100, 6, $row->alamat, 1, 1, 'L', $fill2);

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