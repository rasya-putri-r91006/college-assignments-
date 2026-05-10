<?php

namespace App\Models;
use CodeIgniter\Model;

class M_karyawan extends Model{

    protected $table = "karyawan";
    protected $primaryKey="no_karyawan";
    protected $allowedFields = ['no_karyawan', 'nama_karyawan','alamat','password','foto'];

    function cek_login($no_karyawan,) {
        return $this->getWhere(['no_karyawan' => $no_karyawan]);
    }

    function tampil_data() {
$query = $this->query("SELECT * FROM karyawan ORDER BY no_karyawan ASC");
return $query->getResult();
}
function nomor_otomatis(){
    $query = $this->query("SELECT RIGHT(no_karyawan, 2) AS nomor "
        . "FROM karyawan ORDER BY no_karyawan DESC");
    if ($query->getNumRows() != 0) {
        $nomor = intval($query->getRow()->nomor) + 1;
    } else {
        $nomor = 1;
    }

    $ambil_nomor = str_pad($nomor, 2, "0", STR_PAD_LEFT);
    $nomor_fix   = "IE" . $ambil_nomor;

    return $nomor_fix;
}
function insert_data($no_karyawan, $nama_karyawan, $alamat, $password, $foto){
    $data = ['no_karyawan' => $no_karyawan,
             'nama_karyawan' => $nama_karyawan,
             'alamat' => $alamat,
             'password' => $password,
             'foto' => $foto];
    $this->insert($data);
}

function update_data($no_karyawan,$nama_karyawan, $alamat, $password, $hashedPassword, $foto) {
    $data = ['nama_karyawan' => $nama_karyawan,
             'alamat' => $alamat];
    if (!empty($password)) {
        $data['password'] = $hashedPassword;
    }

    if (!empty($foto)) {
        $data['foto'] = $foto;
    }

    $this->update($no_karyawan, $data);
}

    function delete_data($no_karyawan){
        $this->delete($no_karyawan);
 }
}