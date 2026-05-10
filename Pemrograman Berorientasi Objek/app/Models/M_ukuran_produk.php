<?php

namespace App\Models;
use CodeIgniter\Model;

class M_ukuran_produk extends Model{

    protected $table = "ukuran_produk";
    protected $primaryKey="no_ukuran_produk";
    protected $allowedFields = ['no_ukuran_produk', 'nama_ukuran_produk'];

    function tampil_data() {
$query = $this->query("SELECT * FROM ukuran_produk ORDER BY no_ukuran_produk ASC");
return $query->getResult();
}
function nomor_otomatis(){
    $query = $this->query("SELECT RIGHT(no_ukuran_produk, 2) AS nomor "
        . "FROM ukuran_produk ORDER BY no_ukuran_produk DESC");
    if ($query->getNumRows() != 0) {
        $nomor = intval($query->getRow()->nomor) + 1;
    } else {
        $nomor = 1;
    }

    $ambil_nomor = str_pad($nomor, 4, "0", STR_PAD_LEFT);
    $nomor_fix   = "U" . $ambil_nomor;

    return $nomor_fix;
}
function insert_data($no_ukuran_produk, $nama_ukuran_produk){
    $data = ['no_ukuran_produk' => $no_ukuran_produk,
             'nama_ukuran_produk' => $nama_ukuran_produk,];
    $this->insert($data);
}

function update_data($no_ukuran_produk,$nama_ukuran_produk) {
    $data = ['nama_ukuran_produk' => $nama_ukuran_produk];

    $this->update($no_ukuran_produk, $data);
}

    function delete_data($no_ukuran_produk){
        $this->delete($no_ukuran_produk);
 }
}
