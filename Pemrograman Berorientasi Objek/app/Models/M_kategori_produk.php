<?php

namespace App\Models;
use CodeIgniter\Model;

class M_kategori_produk extends Model{

    protected $table = "kategori_produk";
    protected $primaryKey="no_kategori_produk";
    protected $allowedFields = ['no_kategori_produk', 'nama_kategori_produk'];

    function tampil_data() {
$query = $this->query("SELECT * FROM kategori_produk ORDER BY no_kategori_produk ASC");
return $query->getResult();
}
function nomor_otomatis(){
    $query = $this->query("SELECT RIGHT(no_kategori_produk, 2) AS nomor "
        . "FROM kategori_produk ORDER BY no_kategori_produk DESC");
    if ($query->getNumRows() != 0) {
        $nomor = intval($query->getRow()->nomor) + 1;
    } else {
        $nomor = 1;
    }

    $ambil_nomor = str_pad($nomor, 4, "0", STR_PAD_LEFT);
    $nomor_fix   = "K" . $ambil_nomor;

    return $nomor_fix;
}
function insert_data($no_kategori_produk, $nama_kategori_produk){
    $data = ['no_kategori_produk' => $no_kategori_produk,
             'nama_kategori_produk' => $nama_kategori_produk];
    $this->insert($data);
}

function update_data($no_kategori_produk,$nama_kategori_produk) {
    $data = ['nama_kategori_produk' => $nama_kategori_produk];

    $this->update($no_kategori_produk, $data);
}

    function delete_data($no_kategori_produk){
        $this->delete($no_kategori_produk);
 }
}