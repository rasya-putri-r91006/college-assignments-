import mysql.connector  # type: ignore

def buat_koneksi():
    return mysql.connector.connect(
        host="localhost",
        user="root", 
        password="",
        database="db_kampus"
    )
# MAHASISWA 
def tambah_mahasiswa(nim, nama, jk, alamat, prodi):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("INSERT INTO mahasiswa (nim, nama_mahasiswa, jenis_kelamin, alamat, program_studi) values (%s, %s, %s, %s, %s)", (nim, nama, jk, alamat, prodi))
    koneksi.commit()
    koneksi.close()

def duplikat_nim(nim):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM mahasiswa WHERE nim = %s", (nim,))
    data = cursor.fetchone()
    koneksi.close()
    return data 

def tampil_mahasiswa():
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM mahasiswa ORDER BY nim ASC")
    data = cursor.fetchall()
    koneksi.close()
    return data

def cari_mahasiswa(nim):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM mahasiswa WHERE nim = %s", (nim,))
    data = cursor.fetchone()
    koneksi.close()
    return data 

def ubah_mahasiswa(nim, nama, jk, alamat, prodi):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("UPDATE mahasiswa SET nama_mahasiswa = %s, jenis_kelamin = %s, alamat = %s, program_studi = %s WHERE nim = %s", (nama, jk, alamat, prodi, nim))
    koneksi.commit()
    koneksi.close()

def hapus_mahasiswa(nim):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("DELETE FROM mahasiswa WHERE nim = %s", (nim,))
    koneksi.commit()
    koneksi.close()

# DOSEN 
def tambah_dosen(id_dosen, nama_dosen, ttl, homebase, status_dosen):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("INSERT INTO dosen (id_dosen, nama_dosen, ttl, homebase, status_dosen) values (%s, %s, %s, %s, %s)", (id_dosen, nama_dosen, ttl, homebase, status_dosen))
    koneksi.commit()
    koneksi.close()

def duplikat_id(id_dosen):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM dosen WHERE id_dosen = %s", (id_dosen,))
    data = cursor.fetchone()
    koneksi.close()
    return data 

def tampil_dosen():
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM dosen ORDER BY id_dosen ASC")
    data = cursor.fetchall()
    koneksi.close()
    return data

def cari_dosen(id_dosen):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM dosen WHERE id_dosen = %s", (id_dosen,))
    data = cursor.fetchone()
    koneksi.close()
    return data 

def ubah_dosen(id_dosen, nama_dosen, ttl, homebase, status_dosen):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("UPDATE dosen SET nama_dosen = %s, ttl = %s, homebase = %s, status_dosen = %s WHERE id_dosen = %s", ( nama_dosen, ttl, homebase, status_dosen, id_dosen))
    koneksi.commit()
    koneksi.close()

def hapus_dosen(id_dosen):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("DELETE FROM dosen WHERE id_dosen = %s", (id_dosen,))
    koneksi.commit()
    koneksi.close()
   
#  KARYAWAN
def tambah_karyawan(no_karyawan, nama_karyawan, status_karyawan):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("INSERT INTO karyawan (no_karyawan, nama_karyawan, status_karyawan) values (%s, %s, %s)", (no_karyawan, nama_karyawan, status_karyawan))
    koneksi.commit()
    koneksi.close()

def duplikat_no(no_karyawan):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM karyawan WHERE no_karyawan = %s", (no_karyawan,))
    data = cursor.fetchone()
    koneksi.close()
    return data 

def tampil_karyawan():
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM karyawan ORDER BY no_karyawan ASC")
    data = cursor.fetchall()
    koneksi.close()
    return data

def cari_karyawan(no_karyawan):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM karyawan WHERE no_karyawan = %s", (no_karyawan,))
    data = cursor.fetchone()
    koneksi.close()
    return data 

def ubah_karyawan(no_karyawan, nama_karyawan, status_karyawan):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("UPDATE karyawan SET nama_karyawan = %s, status_karyawan = %s WHERE no_karyawan = %s", ( nama_karyawan, status_karyawan, no_karyawan))
    koneksi.commit()
    koneksi.close()

def hapus_karyawan(no_karyawan):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("DELETE FROM karyawan WHERE no_karyawan = %s", (no_karyawan,))
    koneksi.commit()
    koneksi.close()

# MATA KULIAH
def tambah_mk(kode_mk, nama_mk, jumlah_sks, semester, program_studi):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("INSERT INTO mata_kuliah (kode_mk, nama_mk, jumlah_sks, semester, program_studi) values (%s, %s, %s,%s, %s)", (kode_mk, nama_mk, jumlah_sks, semester, program_studi))
    koneksi.commit()
    koneksi.close()

def duplikat_kode(kode_mk):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM mata_kuliah WHERE kode_mk = %s", (kode_mk,))
    data = cursor.fetchone()
    koneksi.close()
    return data 

def tampil_mk():
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM mata_kuliah ORDER BY kode_mk ASC")
    data = cursor.fetchall()
    koneksi.close()
    return data

def cari_mk(kode_mk):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("SELECT * FROM mata_kuliah WHERE kode_mk = %s", (kode_mk,))
    data = cursor.fetchone()
    koneksi.close()
    return data 

def ubah_mk(kode_mk, nama_mk, jumlah_sks, semester, program_studi):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("UPDATE mata_kuliah SET nama_mk = %s, jumlah_sks = %s, semester = %s, program_studi = %s WHERE kode_mk = %s", ( kode_mk, nama_mk, jumlah_sks, semester, program_studi))
    koneksi.commit()
    koneksi.close()

def hapus_mk(kode_mk):
    koneksi = buat_koneksi()
    cursor = koneksi.cursor()
    cursor.execute("DELETE FROM mata_kuliah WHERE kode_mk = %s", (kode_mk,))
    koneksi.commit()
    koneksi.close()