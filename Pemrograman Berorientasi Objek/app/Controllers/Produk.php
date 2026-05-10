<?php

namespace App\Controllers;

class Produk extends BaseController
{
    public function index(): string
    {
        $cek = session()->get('status_login');
        if (!empty($cek)){
            $data['no_karyawan'] = session()->get('no_karyawan');
            $data['nama_karyawan'] = session()->get('nama_karyawan');
            $data['alamat'] = session()->get('alamat');
            $data['password'] = session()->get('password');
            $data['foto'] = session()->get('foto');
            
            $data['css_js'] = view('v_css_js');
            $data['navbar'] = view('v_navbar',$data);
            $data['sidebar'] = view('v_sidebar');
            $M_produk = new \App\Models\M_produk;
            $data['data_produk'] = $M_produk->tampil_data();
            $data['nomor_otomatis'] = $M_produk->nomor_otomatis();
            $M_merk_produk = new \App\Models\M_merk_produk;
            $data['data_merk_produk'] = $M_merk_produk->tampil_data();
            $M_kategori_produk = new \App\Models\M_kategori_produk;
            $data['data_kategori_produk'] = $M_kategori_produk->tampil_data();
            $M_ukuran_produk = new \App\Models\M_ukuran_produk;
            $data['data_ukuran_produk'] = $M_ukuran_produk->tampil_data();
            return view('v_produk',$data);
        }else{
            $data['css_js'] = view('v_css_js');
            return view('v_login',$data);
        }        
    }
    function simpan(){
        $cek = session()->get('status_login');
        if(!empty($cek)){
            $no_produk = $this->request->getPost('no_produk');
            $nama_produk = $this->request->getPost('nama_produk');
            $nama_kategori_produk = $this->request->getPost('nama_kategori_produk');
            $nama_merk_produk = $this->request->getPost('nama_merk_produk');
            $nama_ukuran_produk = $this->request->getPost('nama_ukuran_produk');
            $harga_beli = $this->request->getPost('harga_beli');
            $harga_jual = $this->request->getPost('harga_jual');
            $stok = $this->request->getPost('stok');
            $M_produk = new \App\Models\M_produk;
            $M_produk->insert_data($no_produk,$nama_produk,$nama_merk_produk,$nama_kategori_produk,$nama_ukuran_produk,
            $harga_beli,$harga_jual,$stok);
            session()->setFlashdata('info','<div class="alert alert-success">
                                             <button type="button" class="close" data-dismiss="alert"> 
                                             <i class="icon-remove"></i>
                                             </button>
                                             <i class="icon-ok"></i>
                                             <strong>PENYIMPANAN DATA BERHASIL<br></strong>
                                             Data sudah tersimpan</div>');
            return redirect()->to('/Produk');
           
        }else{
            return redirect()->to('/login');	
	}
    }
    function ubah(){
        $cek = session()->get('status_login');
        if(!empty($cek)){
            $no_produk = $this->request->getPost('no_produk_edit');
            $nama_produk = $this->request->getPost('nama_produk_edit');
            $nama_kategori_produk = $this->request->getPost('nama_kategori_produk_edit');
            $nama_merk_produk = $this->request->getPost('nama_merk_produk_edit');
            $nama_ukuran_produk = $this->request->getPost('nama_ukuran_produk_edit');
            $harga_beli = $this->request->getPost('harga_beli_edit');
            $harga_jual = $this->request->getPost('harga_jual_edit');
            $stok = $this->request->getPost('stok_edit');
                $M_produk = new \App\Models\M_produk;
                $M_produk->update_data($no_produk,$nama_produk,$nama_merk_produk,$nama_kategori_produk,$nama_ukuran_produk,
            $harga_beli,$harga_jual,$stok);
                session()->setFlashdata('info','<div class="alert alert-success">
                                             <button type="button" class="close" data-dismiss="alert"> 
                                             <i class="icon-remove"></i>
                                             </button>
                                             <i class="icon-ok"></i>
                                             <strong>PERUBAHAN DATA BERHASIL<br></strong>
                                             Data sudah tersimpan</div>');
                return redirect()->to('/Produk');
            
        }else{
            return redirect()->to('/login');	
	}
    }
function hapus(){
        $cek = session()->get('status_login');
        if(!empty($cek)){
            $no_produk = $this->request->getUri()->getSegment(3);
            $M_produk = new \App\Models\M_produk;
            $M_produk->delete_data($no_produk);
            session()->setFlashdata('info','<div class="alert alert-success">
                                         <button type="button" class="close" data-dismiss="alert"> 
                                         <i class="icon-remove"></i>
                                         </button>
                                         <i class="icon-ok"></i>
                                         <strong>PENGHAPUSAN BERHASIL<br></strong>
                                         Data sudah dihapus pada database</div>');
            return redirect()->to('/Produk');
            
        }else{
            return redirect()->to('/login');	
	}
    }
function cetak(){
        $cek = session()->get('status_login');
        if(!empty($cek)){ 
            require_once APPPATH . 'fpdf186/fpdf.php';
            $pdf = new \FPDF('L','mm','A4');
            $pdf->AddPage();
            $pdf->SetTitle("CETAK DAFTAR PRODUK");
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(280,7,"DAFTAR PRODUK",0,1,'C');
            $pdf->Cell(2,7,'',0,1);
            $pdf->SetFillColor(27,7,67);
            $pdf->SetTextColor(255);
            $fill=true;
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(10,6,'NO',1,0,'C',$fill);
            $pdf->Cell(22,6,'NO PRODUK',1,0,'C',$fill);
            $pdf->Cell(75,6,'NAMA PRODUK',1,0,'C',$fill);
            $pdf->Cell(30,6,'MERK',1,0,'C',$fill);
            $pdf->Cell(30,6,'KATEGORI',1,0,'C',$fill);
            $pdf->Cell(30,6,'UKURAN',1,0,'C',$fill);
            $pdf->Cell(30,6,'HARGA BELI',1,0,'C',$fill);
            $pdf->Cell(30,6,'HARGA JUAL',1,0,'C',$fill);
            $pdf->Cell(20,6,'STOK',1,1,'C',$fill);
            $pdf->SetFont('Arial','',9);
            $pdf->SetFillColor(204,229,250);
            $pdf->SetTextColor(0);
            $fill2=false;
            $M_produk = new \App\Models\M_produk;
            $data = $M_produk->tampil_data();
            $no=1;
            foreach ($data as $row){
                $pdf->Cell(10,6,$no,1,0,'C',$fill2);
                $pdf->Cell(22,6,$row->no_produk,1,0,'C',$fill2);
                $pdf->Cell(75,6,$row->nama_produk,1,0,'L',$fill2);
                $pdf->Cell(30,6,$row->nama_merk_produk,1,0,'C',$fill2);
                $pdf->Cell(30,6,$row->nama_kategori_produk,1,0,'C',$fill2);
                $pdf->Cell(30,6,$row->nama_ukuran_produk,1,0,'C',$fill2);
                $pdf->Cell(30,6,number_format($row->harga_beli),1,0,'R',$fill2);
                $pdf->Cell(30,6,number_format($row->harga_jual),1,0,'R',$fill2);
                $pdf->Cell(20,6,$row->stok,1,1,'C',$fill2);
                $fill2=!$fill2;
                $no++;
            }
            $pdf->Output(); 
            exit;
	}else{
            return redirect()->to('/login');	
	}
    }

}