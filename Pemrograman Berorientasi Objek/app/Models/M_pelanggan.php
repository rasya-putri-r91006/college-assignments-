<?php

namespace App\Models;
use CodeIgniter\Model;

class M_pelanggan extends Model{

    protected $table = "pelanggan";
    protected $primaryKey="no_pelanggan";
    protected $allowedFields = ['no_pelanggan', 'nama_pelanggan','alamat','no_telp','foto'];

    function tampil_data() {
$query = $this->query("SELECT * FROM pelanggan ORDER BY no_pelanggan ASC");
return $query->getResult();
}
function nomor_otomatis(){
    $query = $this->query("SELECT RIGHT(no_pelanggan, 2) AS nomor "
        . "FROM pelanggan ORDER BY no_pelanggan DESC");
    if ($query->getNumRows() != 0) {
        $nomor = intval($query->getRow()->nomor) + 1;
    } else {
        $nomor = 1;
    }

    $ambil_nomor = str_pad($nomor, 4, "0", STR_PAD_LEFT);
    $nomor_fix   = "P" . $ambil_nomor;

    return $nomor_fix;
}
function insert_data($no_pelanggan, $nama_pelanggan, $alamat, $no_telp, $foto){
    $data = ['no_pelanggan' => $no_pelanggan,
             'nama_pelanggan' => $nama_pelanggan,
             'alamat' => $alamat,
             'no_telp' => $no_telp,
             'foto' => $foto];
    $this->insert($data);
}

function update_data($no_pelanggan,$nama_pelanggan, $alamat, $no_telp, $foto) {
    $data = ['nama_pelanggan' => $nama_pelanggan,
             'alamat' => $alamat];

    if (!empty($foto)) {
        $data['foto'] = $foto;
    }

    $this->update($no_pelanggan, $data);
}

    function delete_data($no_pelanggan){
        $this->delete($no_pelanggan);
 }
}