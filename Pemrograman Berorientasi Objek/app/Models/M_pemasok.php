<?php

namespace App\Models;
use CodeIgniter\Model;

class M_pemasok extends Model{

    protected $table = "pemasok";
    protected $primaryKey="no_pemasok";
    protected $allowedFields = ['no_pemasok', 'nama_pemasok','alamat','no_telp','foto'];

    function tampil_data() {
$query = $this->query("SELECT * FROM pemasok ORDER BY no_pemasok ASC");
return $query->getResult();
}
function nomor_otomatis(){
    $query = $this->query("SELECT RIGHT(no_pemasok, 2) AS nomor "
        . "FROM pemasok ORDER BY no_pemasok DESC");
    if ($query->getNumRows() != 0) {
        $nomor = intval($query->getRow()->nomor) + 1;
    } else {
        $nomor = 1;
    }

    $ambil_nomor = str_pad($nomor, 4, "0", STR_PAD_LEFT);
    $nomor_fix   = "D" . $ambil_nomor;

    return $nomor_fix;
}
function insert_data($no_pemasok, $nama_pemasok, $alamat, $no_telp, $foto){
    $data = ['no_pemasok' => $no_pemasok,
             'nama_pemasok' => $nama_pemasok,
             'alamat' => $alamat,
             'no_telp' => $no_telp,
             'foto' => $foto];
    $this->insert($data);
}

function update_data($no_pemasok,$nama_pemasok, $alamat, $no_telp, $foto) {
    $data = ['nama_pemasok' => $nama_pemasok,
             'alamat' => $alamat];

    if (!empty($foto)) {
        $data['foto'] = $foto;
    }

    $this->update($no_pemasok, $data);
}

    function delete_data($no_pemasok){
        $this->delete($no_pemasok);
 }
}