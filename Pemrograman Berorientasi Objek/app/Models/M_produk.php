<?php
namespace App\Models;
use CodeIgniter\Model;

class M_produk extends Model {
    protected $table ='produk';
    protected $primaryKey = 'no_produk';
    protected $allowedFields =['no_produk','nama_produk','nama_merk_produk','nama_kategori_produk',
        'nama_ukuran_produk','harga_beli','harga_jual','stok'];

    
    function tampil_data() {
        $query = $this->query("SELECT * FROM produk ORDER BY no_produk ASC");
        return $query->getResult();
    }
    
    function nomor_otomatis(){
        $query = $this->query("SELECT right(no_produk,6) as nomor "
                . "FROM produk ORDER BY no_produk DESC");
        if ($query->getNumRows()<>0){
            $nomor = intval($query->getRow()->nomor)+1;
        }else{
            $nomor = 1;
        }
        $ambil_nomor = str_pad($nomor, 6, "0", STR_PAD_LEFT);
        $nomor_fix = "PRD-".$ambil_nomor;
        return $nomor_fix;
    }
    
    function insert_data($no_produk,$nama_produk,$nama_merk_produk,$nama_kategori_produk,$nama_ukuran_produk,
            $harga_beli,$harga_jual,$stok){            
            $data = ['no_produk' => $no_produk,
                'nama_produk' => $nama_produk,
            'nama_merk_produk' => $nama_merk_produk,
            'nama_kategori_produk' => $nama_kategori_produk,
            'nama_ukuran_produk' => $nama_ukuran_produk,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'stok' => $stok];
        $this->insert($data);   
    }
    
    function update_data($no_produk,$nama_produk,$nama_merk_produk,$nama_kategori_produk,$nama_ukuran_produk,
            $harga_beli,$harga_jual,$stok){
            $data = ['nama_produk' => $nama_produk,
            'nama_merk_produk' => $nama_merk_produk,
            'nama_kategori_produk' => $nama_kategori_produk,
            'nama_ukuran_produk' => $nama_ukuran_produk,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'stok' => $stok];
        $this->update($no_produk, $data);
    }
    
    function delete_data($no_produk){
        $this->delete($no_produk);
    }
}

