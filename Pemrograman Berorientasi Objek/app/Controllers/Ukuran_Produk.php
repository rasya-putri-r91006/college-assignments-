<?php

namespace App\Controllers;

class Ukuran_produk extends BaseController
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

            $M_ukuran_produk = new \App\Models\M_ukuran_produk;
            $data['data_ukuran_produk'] = $M_ukuran_produk->tampil_data();
            $data['nomor_otomatis'] = $M_ukuran_produk->nomor_otomatis();
            return view('v_ukuran_produk', $data);
        }else{
            $data['css_js'] = view('v_css_js');
            return view('v_login', $data);
        }
        
    }

function simpan(){
    $cek = session()->get('status_login');
    if (!empty($cek)) {

        $no_ukuran_produk = $this->request->getPost('no_ukuran_produk');
        $nama_ukuran_produk = $this->request->getPost('nama_ukuran_produk');

        $M_ukuran_produk = new \App\Models\M_ukuran_produk;
        $M_ukuran_produk->insert_data($no_ukuran_produk, $nama_ukuran_produk);

        session()->setFlashdata('info', '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
                </button>
                <i class="icon-ok"></i>
                <strong>PENYIMPANAN DATA BERHASIL<br></strong>
                Data sudah tersimpan
            </div>');

        return redirect()->to('/Ukuran_produk');

    } else {
        return redirect()->to('/login');
    }
}

function ubah(){
    $cek = session()->get('status_login');
    if (!empty($cek)) {

        $no_ukuran_produk   = $this->request->getPost('no_ukuran_produk_edit');
        $nama_ukuran_produk = $this->request->getPost('nama_ukuran_produk_edit');

        $M_ukuran_produk = new \App\Models\M_ukuran_produk;
        $M_ukuran_produk->update_data($no_ukuran_produk, $nama_ukuran_produk);

        session()->setFlashdata('info', '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
                </button>
                <i class="icon-ok"></i>
                <strong>PERUBAHAN DATA BERHASIL<br></strong>
                Data sudah tersimpan
            </div>');

        return redirect()->to('/Ukuran_produk');

    } else {
        return redirect()->to('/login');
    }
}

function hapus(){
    $cek = session()->get('status_login');
    if (!empty($cek)) {
        $no_ukuran_produk = $this->request->getUri()->getSegment(3);
        $M_ukuran_produk = new \App\Models\M_ukuran_produk;
        $M_ukuran_produk->delete_data($no_ukuran_produk);
        session()->setFlashdata('info', '<div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">
                                    <i class="icon-remove"></i>
                                    </button>
                                    <i class="icon-ok"></i>
                                    <strong>PENGHAPUSAN BERHASIL<br></strong>
                                    Data sudah dihapus pada database</div>');
        return redirect()->to('/Ukuran_produk');

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
        $pdf->SetTitle("CETAK DAFTAR UKURAN PRODUK");
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(260, 7, "DAFTAR UKURAN PRODUK", 0, 1, 'C');
        $pdf->Cell(2, 7, '', 0, 1);
        $pdf->SetFillColor(27, 7, 67);
        $pdf->SetTextColor(255);
        $fill = true;
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'NO', 1, 0, 'C', $fill);
        $pdf->Cell(132, 6, 'NO UKURAN PRODUK', 1, 0, 'C', $fill);
        $pdf->Cell(133, 6, 'NAMA UKURAN PRODUK', 1, 1, 'C', $fill);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(204, 229, 250);
        $pdf->SetTextColor(0);
        $fill2 = false;
        $M_ukuran_produk = new \App\Models\M_ukuran_produk;
        $data       = $M_ukuran_produk->tampil_data();
        $no = 1;
        foreach ($data as $row) {
            $pdf->Cell(10, 6, $no, 1, 0, 'C', $fill2);
            $pdf->Cell(132, 6, $row->no_ukuran_produk, 1, 0, 'C', $fill2);
            $pdf->Cell(133, 6, $row->nama_ukuran_produk, 1, 1, 'L', $fill2);

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