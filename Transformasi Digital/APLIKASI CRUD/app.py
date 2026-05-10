import streamlit as st  # type: ignore
from db import tambah_mahasiswa, duplikat_nim, tampil_mahasiswa, cari_mahasiswa, ubah_mahasiswa, hapus_mahasiswa, tambah_dosen, duplikat_id, tampil_dosen, cari_dosen, ubah_dosen, hapus_dosen, tambah_karyawan, duplikat_no, tampil_karyawan, cari_karyawan, ubah_karyawan, hapus_karyawan, tambah_mk, duplikat_kode, tampil_mk, cari_mk, ubah_mk, hapus_mk
import pandas as pd  # type: ignore
from pdf import cetak_pdf, cetak_pdf_dosen, cetak_pdf_karyawan, cetak_pdf_mk

def kosongkan_input():
    st.session_state["input_nama"] = ""
    st.session_state["input_nim"] = ""
    st.session_state["input_alamat"] = ""
    st.session_state["input_jk"] = "Laki-laki"
    st.session_state["input_prodi"] = "Informatika"

def kosongkan_input1():
    st.session_state["input_nama-dosen"] = ""
    st.session_state["input_id"] = ""
    st.session_state["input_ttl"] = ""
    st.session_state["input_homebase"] = "Informatika"
    st.session_state["input_status"] = "Tetap"

def kosongkan_input2():
    st.session_state["input_nama-karyawan"] = ""
    st.session_state["input_no"] = ""
    st.session_state["input_status"] = "Tetap"

def kosongkan_input3():
    st.session_state["input_nama"] = ""
    st.session_state["input_kode"] = ""
    st.session_state["input_jumlah"] = ""
    st.session_state["input_semester"] = "1"
    st.session_state["input_prodi"] = "Informatika"


st.title("Aplikasi Kelola Akademik")

# menu kelola
menu_kelola = st.sidebar.selectbox("Menu Kelola", ["Mahasiswa", "Dosen", "Karyawan", "Mata Kuliah"])

# sub menu berdasarkan memu kelola
# KELOLA MAHASISWA 
if menu_kelola == "Mahasiswa":
    sub_menu = ["Tambah Data", "Tampil Data", "Ubah Data", "Hapus Data"]
    menu_utama = st.sidebar.selectbox("Kelola Mahasiswa", sub_menu)

    if menu_utama == "Tambah Data":
        st.subheader("Tambah Data Mahasiswa")
        st.text_input("NIM", key="input_nim")
        st.text_input("Nama Mahasiswa", key="input_nama")
        st.selectbox(
            "Jenis Kelamin:",
            ("Laki-laki", "Perempuan"), key="input_jk"
        )
        st.text_area("Alamat :", height=100, key="input_alamat")
        st.selectbox(
            "Program Studi:",
            ("Informatika", "Sistem Informasi"), key="input_prodi"
        )
        nim = st.session_state["input_nim"]
        nama = st.session_state["input_nama"]
        jk = st.session_state["input_jk"]
        alamat = st.session_state["input_alamat"]
        prodi = st.session_state["input_prodi"]
        if st.button("Simpan"):
            if nim.strip() == "" or nama.strip() == "" or jk.strip() == "" or alamat.strip() == "" or prodi.strip() == "":
                st.warning("Cek kembali masih ada data yang masih kosong")
            else:
                cek_nim = duplikat_nim(nim)
                if cek_nim:
                    st.warning("Duplikasi NIM, silahkan cek kembali")
                else:
                    tambah_mahasiswa(nim, nama, jk, alamat, prodi)
                    st.success("Data Mahasiswa berhasil disimpan")
                    st.button("Tambah Baru", on_click=kosongkan_input)

    elif menu_utama == "Tampil Data":
        st.subheader("Tampilkan Data Mahasiswa")
        mahasiswa = tampil_mahasiswa()
        df = pd.DataFrame(mahasiswa, columns=["NIM", "Nama", "Jenis Kelamin", "Alamat", "Program Studi"])
        df.index = range(1, len(df) + 1)
        search = st.text_input("Cari berdasarkan nama mahasiswa:")
        if search:
            df = df[df["Nama"].str.contains(search, case=False)]
        st.dataframe(df, use_container_width=True)
        if st.button("Cetak Ke PDF"):
            if not df.empty:
                filepath = cetak_pdf(df.values.tolist())
                with open(filepath, "rb") as f:
                    st.download_button("Unduh PDF", f, file_name="daftar_mahasiswa.pdf", mime="application/pdf")
            else:
                st.warning("Data Mahasiswa kosong, tidak dapat dicetak")

    elif menu_utama == "Ubah Data":
        st.subheader("Ubah Data Mahasiswa")
        mahasiswa = tampil_mahasiswa()
        nim = [str(u[0]) for u in mahasiswa]
        pilih_nim = st.selectbox("Pilih NIM", nim)
        if pilih_nim:
            data_terpilih = cari_mahasiswa(pilih_nim)
            if data_terpilih:
                data_nama = data_terpilih[1]
                data_jk = data_terpilih[2]
                data_alamat = data_terpilih[3]
                data_prodi = data_terpilih[4]
                nama_baru = st.text_input("Nama Mahasiswa Baru", value=data_nama)
                opsi_jk = ["Laki-laki", "Perempuan"]
                jk_index = opsi_jk.index(data_jk) if data_jk in opsi_jk else 0
                jk_baru = st.selectbox("Jenis Kelamin:", opsi_jk, index=jk_index)
                alamat_baru = st.text_area("Alamat :", height=100, value=data_alamat)
                opsi_prodi = ["Informatika", "Sistem Informasi"]
                prodi_index = opsi_prodi.index(data_prodi) if data_prodi in opsi_prodi else 0
                prodi_baru = st.selectbox("Program Studi:", opsi_prodi, index=prodi_index)
                if st.button("Ubah"):
                    if nama_baru.strip() == "" or alamat_baru.strip() == "":
                        st.warning("Nama Mahasiswa dan Alamat tidak boleh kosong!")
                    else:
                        ubah_mahasiswa(pilih_nim, nama_baru, jk_baru, alamat_baru, prodi_baru)
                        st.success("Data berhasil diperbaharui!")

    elif menu_utama == "Hapus Data":
        st.subheader("Hapus Data Mahasiswa")
        mahasiswa = tampil_mahasiswa()
        nim = [str(u[0]) for u in mahasiswa]
        pilih_nim = st.selectbox("Pilih NIM", nim)

        if pilih_nim:
            data_terpilih = cari_mahasiswa(pilih_nim)
            if data_terpilih:
                data_nama = data_terpilih[1]
                data_jk = data_terpilih[2]
                data_alamat = data_terpilih[3]
                data_prodi = data_terpilih[4]
                nama_baru = st.text_input("Nama Mahasiswa Baru", value=data_nama, disabled=True)
                jk_baru = st.text_input("Jenis Kelamin Baru", value=data_jk, disabled=True)
                data_alamat = st.text_input("Alamat Baru", value=data_alamat, disabled=True)
                prodi_baru = st.text_input("Program Studi Baru", value=data_prodi, disabled=True)
                st.warning("💡Anda yakin ingin menghapus data mahasiswa tersebut?")
                confirm = st.checkbox("✔️ Ya, saya yakin")
                if st.button("Hapus"):
                    if confirm:
                        hapus_mahasiswa(pilih_nim)
                        st.success("Data Mahasiswa berhasil dihapus")
                    else:
                        st.error("❌ Penghapusan dibatalkan, mohon centang konfirmasi terlebih dahulu")

# KELOLA DOSEN
elif menu_kelola == "Dosen":
    sub_menu = ["Tambah Data", "Tampil Data", "Ubah Data", "Hapus Data"]
    menu_utama = st.sidebar.selectbox("Kelola Dosen", sub_menu)
    if menu_utama == "Tambah Data":
        st.subheader("Tambah Data Dosen")
        st.text_input("Id_Dosen", key="input_id")
        st.text_input("Nama Dosen", key="input_nama-dosen")
        st.text_input("Tempat Tanggal Lahir", key="input_ttl")
        st.selectbox(
            "Homebase:",
            ("Informatika", "Sistem Informasi"), key="input_homebase"
        )
        st.selectbox(
            "Status Dosen:",
            ("Tetap", "Tidak Tetap"), key="input_status"
        )
        id_dosen = st.session_state["input_id"]
        nama_dosen = st.session_state["input_nama-dosen"]
        ttl = st.session_state["input_ttl"]
        homebase = st.session_state["input_homebase"]
        status_dosen = st.session_state["input_status"]
        if st.button("Simpan"):
            if id_dosen.strip() == "" or nama_dosen.strip() == "" or ttl.strip() == "" or homebase.strip() == "" or status_dosen.strip() == "":
                st.warning("Cek kembali masih ada data yang masih kosong")
            else:
                cek_id = duplikat_id(id_dosen)
                if cek_id:
                    st.warning("Duplikasi Id_Dosen, silahkan cek kembali")
                else:
                    tambah_dosen(id_dosen, nama_dosen, ttl, homebase, status_dosen)
                    st.success("Data Dosen berhasil disimpan")
                    st.button("Tambah Baru", on_click=kosongkan_input1)
    elif menu_utama == "Tampil Data":
        st.subheader("Tampilkan Data Dosen")
        dosen = tampil_dosen()
        df = pd.DataFrame(dosen, columns=["Id Dosen", "Nama Dosen", "Tempat Tanggal Lahir", "Homebase", "Status Dosen"])
        df.index = range(1, len(df) + 1)
        search = st.text_input("Cari berdasarkan Nama Dosen:")
        if search:
            df = df[df["Nama"].str.contains(search, case=False)]
        st.dataframe(df, use_container_width=True)
        if st.button("Cetak Ke PDF"):
            if not df.empty:
                filepath = cetak_pdf_dosen(df.values.tolist())
                with open(filepath, "rb") as f:
                    st.download_button("Unduh PDF", f, file_name="daftar_dosen.pdf", mime="application/pdf")
            else:
                st.warning("Data Dosen kosong, tidak dapat dicetak")
    elif menu_utama == "Ubah Data":
        st.subheader("Ubah Data Dosen")
        dosen = tampil_dosen()
        id_dosen = [str(u[0]) for u in dosen]
        pilih_id = st.selectbox("Pilih NIM", id_dosen)
        if pilih_id:
            data_terpilih = cari_dosen(pilih_id)
            if data_terpilih:
                data_nama = data_terpilih[1]
                data_ttl = data_terpilih[2]
                data_homebase = data_terpilih[3]
                data_status = data_terpilih[4]
                nama_baru = st.text_input("Nama Dosen Baru", value=data_nama)
                ttl_baru = st.text_input("Tempat Tanggal Lahir Baru", value=data_ttl)
                opsi_homebase = ["Informatika", "Sistem Informasi"]
                homebase_index = opsi_homebase.index(data_homebase) if data_homebase in opsi_homebase else 0
                homebase_baru = st.selectbox("Homebase:", opsi_homebase, index=homebase_index)
                opsi_status = ["Tetap", "Tidak Tetap"]
                status_index = opsi_status.index(data_status) if data_status in opsi_status else 0
                status_baru = st.selectbox("Status Baru:", opsi_status, index=status_index)
                if st.button("Ubah"):
                    if nama_baru.strip() == "" or status_baru.strip() == "":
                        st.warning("Nama Dosen dan Alamat tidak boleh kosong!")
                    else:
                        ubah_dosen(pilih_id, nama_baru, ttl_baru, homebase_baru, status_baru)
                        st.success("Data berhasil diperbaharui!")
    elif menu_utama == "Hapus Data":
        st.subheader("Hapus Data Mahasiswa")
        dosen = tampil_dosen()
        id_dosen = [str(u[0]) for u in dosen]
        pilih_id = st.selectbox("Pilih Id Dosen", id_dosen)

        if pilih_id:
            data_terpilih = cari_dosen(pilih_id)
            if data_terpilih:
                data_nama = data_terpilih[1]
                data_ttl = data_terpilih[2]
                data_homebase = data_terpilih[3]
                data_status = data_terpilih[4]
                nama_baru = st.text_input("Nama Mahasiswa Baru", value=data_nama, disabled=True)
                ttl_baru = st.text_input("Jenis Kelamin Baru", value=data_ttl, disabled=True)
                data_homebase = st.text_input("Alamat Baru", value=data_homebase, disabled=True)
                status_baru = st.text_input("Program Studi Baru", value=data_status, disabled=True)
                st.warning("💡Anda yakin ingin menghapus data Dosen tersebut?")
                confirm = st.checkbox("✔️ Ya, saya yakin")
                if st.button("Hapus"):
                    if confirm:
                        hapus_dosen(pilih_id)
                        st.success("Data Dosen berhasil dihapus")
                    else:
                        st.error("❌ Penghapusan dibatalkan, mohon centang konfirmasi terlebih dahulu")

# KELOLA KARYAWAN
elif menu_kelola == "Karyawan":
    sub_menu = ["Tambah Data", "Tampil Data", "Ubah Data", "Hapus Data"]
    menu_utama = st.sidebar.selectbox("Kelola Karyawan", sub_menu)
    if menu_utama == "Tambah Data":
        st.subheader("Tambah Data Karyawan")
        st.text_input("No Karyawan", key="input_no")
        st.text_input("Nama Karyawan", key="input_nama-karyawan")
        st.selectbox(
            "Status Karyawan:",
            ("Tetap", "Honorer"), key="input_status"
        )
        no_karyawan = st.session_state["input_no"]
        nama_karyawan = st.session_state["input_nama-karyawan"]
        status_karyawan = st.session_state["input_status"]
        if st.button("Simpan"):
            if no_karyawan.strip() == "" or nama_karyawan.strip() == "" or status_karyawan.strip() == "":
                st.warning("Cek kembali masih ada data yang masih kosong")
            else:
                cek_id = duplikat_no(no_karyawan)
                if cek_id:
                    st.warning("Duplikasi Id_Dosen, silahkan cek kembali")
                else:
                    tambah_karyawan(no_karyawan, nama_karyawan, status_karyawan)
                    st.success("Data Dosen berhasil disimpan")
                    st.button("Tambah Baru", on_click=kosongkan_input2)
    elif menu_utama == "Tampil Data":
        st.subheader("Tampilkan Data Karyawan")
        karyawan = tampil_karyawan()
        df = pd.DataFrame(karyawan, columns=["No Karyawan", "Nama Karyawan", "Status Karyawan"])
        df.index = range(1, len(df) + 1)
        search = st.text_input("Cari berdasarkan Nama Karyawan:")
        if search:
            df = df[df["Nama"].str.contains(search, case=False)]
        st.dataframe(df, use_container_width=True)
        if st.button("Cetak Ke PDF"):
            if not df.empty:
                filepath = cetak_pdf_karyawan(df.values.tolist())
                with open(filepath, "rb") as f:
                    st.download_button("Unduh PDF", f, file_name="daftar_karyawan.pdf", mime="application/pdf")
            else:
                st.warning("Data Karyawan kosong, tidak dapat dicetak")
    elif menu_utama == "Ubah Data":
        st.subheader("Ubah Data Karyawan")
        karyawan = tampil_karyawan()
        no_karyawan = [str(u[0]) for u in karyawan]
        pilih_id = st.selectbox("Pilih NIM", no_karyawan)
        if pilih_id:
            data_terpilih = cari_karyawan(pilih_id)
            if data_terpilih:
                data_nama = data_terpilih[1]
                data_status = data_terpilih[2]
                nama_baru = st.text_input("Nama Karyawan Baru", value=data_nama)
                opsi_status = ["Tetap", "Honorer"]
                status_index = opsi_status.index(data_status) if data_status in opsi_status else 0
                status_baru = st.selectbox("Status:", opsi_status, index=status_index)
                if st.button("Ubah"):
                    if nama_baru.strip() == "" or status_baru.strip() == "":
                        st.warning("Nama Karyawan dan Alamat tidak boleh kosong!")
                    else:
                        ubah_karyawan(pilih_id, nama_baru, status_baru)
                        st.success("Data berhasil diperbaharui!")
    elif menu_utama == "Hapus Data":
        st.subheader("Hapus Data Karyawan")
        karyawan = tampil_karyawan()
        no_karyawan = [str(u[0]) for u in karyawan]
        pilih_id = st.selectbox("Pilih No Karyawan", no_karyawan)

        if pilih_id:
            data_terpilih = cari_karyawan(pilih_id)
            if data_terpilih:
                data_nama = data_terpilih[1]
                data_status = data_terpilih[2]
                nama_baru = st.text_input("Nama Mahasiswa Baru", value=data_nama, disabled=True)
                status_baru = st.text_input("Status Baru", value=data_status, disabled=True)
                st.warning("💡Anda yakin ingin menghapus data Dosen tersebut?")
                confirm = st.checkbox("✔️ Ya, saya yakin")
                if st.button("Hapus"):
                    if confirm:
                        hapus_karyawan(pilih_id)
                        st.success("Data Karyawan berhasil dihapus")
                    else:
                        st.error("❌ Penghapusan dibatalkan, mohon centang konfirmasi terlebih dahulu")

# KELOLA MATA KULIAH
elif menu_kelola == "Mata Kuliah":
    sub_menu = ["Tambah Data", "Tampil Data", "Ubah Data", "Hapus Data"]
    menu_utama = st.sidebar.selectbox("Kelola Mata Kuliah", sub_menu)
    if menu_utama == "Tambah Data":
        st.subheader("Tambah Data Mata Kuliah")
        st.text_input("Kode Mata Kuliah", key="input_kode")
        st.text_input("Nama Mata Kuliah", key="input_nama")
        st.text_input("Jumlah SKS", key="input_jumlah")
        st.selectbox(
            "Semester:",
            ("1", "2", "3", "4", "5", "6", "7", "8"), key="input_semester"
        )
        st.selectbox(
            "Program Studi:",
            ("Informatika", "Sistem Informasi"), key="input_prodi"
        )
        kode_mk = st.session_state["input_kode"]
        nama_mk = st.session_state["input_nama"]
        jumlah = st.session_state["input_jumlah"]
        semester = st.session_state["input_semester"]
        prodi = st.session_state["input_prodi"]
        if st.button("Simpan"):
            if kode_mk.strip() == "" or nama_mk.strip() == "" or jumlah.strip() == "" or semester.strip() == "" or prodi.strip() == "":
                st.warning("Cek kembali masih ada data yang masih kosong")
            else:
                cek_id = duplikat_kode(kode_mk)
                if cek_id:
                    st.warning("Duplikasi Kode Mata Kuliah, silahkan cek kembali")
                else:
                    tambah_mk(kode_mk, nama_mk, jumlah, semester, prodi)
                    st.success("Data Dosen berhasil disimpan")
                    st.button("Tambah Baru", on_click=kosongkan_input3)
    elif menu_utama == "Tampil Data":
        st.subheader("Tampilkan Data Mata Kuliah")
        mk = tampil_mk()
        df = pd.DataFrame(mk, columns=["Kode Mata Kuliah", "Nama Mata Kuliah", "Jumlah SKS", "Semester", "Program Studi"])
        df.index = range(1, len(df) + 1)
        search = st.text_input("Cari berdasarkan Nama Mata Kuliah:")
        if search:
            df = df[df["Nama Mata Kuliah"].str.contains(search, case=False)]
        st.dataframe(df, use_container_width=True)
        if st.button("Cetak Ke PDF"):
            if not df.empty:
                filepath = cetak_pdf_mk(df.values.tolist())
                with open(filepath, "rb") as f:
                    st.download_button("Unduh PDF", f, file_name="daftar_Matakuliah.pdf", mime="application/pdf")
            else:
                st.warning("Data Mata Kuliah kosong, tidak dapat dicetak")
    elif menu_utama == "Ubah Data":
        st.subheader("Ubah Data Mata Kuliah")
        mk = tampil_mk()
        kode_mk = [str(u[0]) for u in mk]
        pilih_kode = st.selectbox("Pilih Kode Mata Kuliah", kode_mk)
        if pilih_kode:
            data_terpilih = cari_mk(pilih_kode)
            if data_terpilih:
                data_nama = data_terpilih[1]
                data_jml = data_terpilih[2]
                data_semester = data_terpilih[3]
                data_prodi = data_terpilih[4]
                nama_baru = st.text_input("Nama Mata Kuliah Baru", value=data_nama)
                jml_baru = st.text_input("Jumlah SKS", value=data_jml)
                opsi_semester = ["1", "2", "3", "4", "5", "6", "7", "8"]
                semester_index = opsi_semester.index(data_semester) if data_semester in opsi_semester else 0
                semester_baru = st.selectbox("Semester:", opsi_semester, index=semester_index)
                opsi_prodi = ["Informatika", "Sistem Informasi"]
                prodi_index = opsi_prodi.index(data_prodi) if data_prodi in opsi_prodi else 0
                prodi_baru = st.selectbox("Program Dtudi Baru:", opsi_prodi, index=prodi_index)
                if st.button("Ubah"):
                    if nama_baru.strip() == "" or semester_baru.strip() == "":
                        st.warning("Nama Mata Kuliah dan Semester tidak boleh kosong!")
                    else:
                        ubah_mk(pilih_kode, nama_baru, jml_baru, semester_baru, prodi_baru)
                        st.success("Data berhasil diperbaharui!")
    elif menu_utama == "Hapus Data":
        st.subheader("Hapus Data Mata Kuliah")
        mk = tampil_mk()
        kode_mk = [str(u[0]) for u in mk]
        pilih_kode = st.selectbox("Pilih Kode Mata Kuliah", kode_mk)

        if pilih_kode:
            data_terpilih = cari_mk(pilih_kode)
            if data_terpilih:
                data_nama = data_terpilih[1]
                data_jml = data_terpilih[2]
                data_semester = data_terpilih[3]
                data_prodi = data_terpilih[4]
                nama_baru = st.text_input("Nama Mahasiswa Baru", value=data_nama, disabled=True)
                jml_baru = st.text_input("Jenis Kelamin Baru", value=data_jml, disabled=True)
                data_semester = st.text_input("Alamat Baru", value=data_semester, disabled=True)
                prodi_baru = st.text_input("Program Studi Baru", value=data_prodi, disabled=True)
                st.warning("💡Anda yakin ingin menghapus data Mata Kuliah tersebut?")
                confirm = st.checkbox("✔️ Ya, saya yakin")
                if st.button("Hapus"):
                    if confirm:
                        hapus_mk(pilih_kode)
                        st.success("Data Mata Kuliah berhasil dihapus")
                    else:
                        st.error("❌ Penghapusan dibatalkan, mohon centang konfirmasi terlebih dahulu")