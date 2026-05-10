<?php

namespace App\Models;
use CodeIgniter\Model;

class M_merk_produk extends Model{

    protected $table = "merk_produk";
    protected $primaryKey="no_merk_produk";
    protected $allowedFields = ['no_merk_produk', 'nama_merk_produk'];

    function tampil_data() {
$query = $this->query("SELECT * FROM merk_produk ORDER BY no_merk_produk ASC");
return $query->getResult();
}
function nomor_otomatis(){
    $query = $this->query("SELECT RIGHT(no_merk_produk, 2) AS nomor "
        . "FROM merk_produk ORDER BY no_merk_produk DESC");
    if ($query->getNumRows() != 0) {
        $nomor = intval($query->getRow()->nomor) + 1;
    } else {
        $nomor = 1;
    }

    $ambil_nomor = str_pad($nomor, 4, "0", STR_PAD_LEFT);
    $nomor_fix   = "M" . $ambil_nomor;

    return $nomor_fix;
}
function insert_data($no_merk_produk, $nama_merk_produk){
    $data = ['no_merk_produk' => $no_merk_produk,
             'nama_merk_produk' => $nama_merk_produk];
    $this->insert($data);
}

function update_data($no_merk_produk,$nama_merk_produk) {
    $data = ['nama_merk_produk' => $nama_merk_produk];

    $this->update($no_merk_produk, $data);
}

    function delete_data($no_merk_produk){
        $this->delete($no_merk_produk);
 }
}