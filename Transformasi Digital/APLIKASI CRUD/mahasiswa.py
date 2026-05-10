import streamlit as st # type: ignore
from db import tambah_mahasiswa, duplikat_nim, tampil_mahasiswa, cari_mahasiswa, ubah_mahasiswa, hapus_mahasiswa
import pandas as pd # type: ignore
from pdf import cetak_pdf

def kosongkan_input():
    st.session_state["input_nama"] = ""
    st.session_state["input_nim"] = ""
    st.session_state["input_alamat"] = ""
    st.session_state["input_jk"] = "Laki-laki"
    st.session_state["input_prodi"] = "Informatika"

st.title("Aplikasi Kelola Mahasiswa")
sub_menu = ["Tambah Data", "Tampil Data", "Ubah Data", "Hapus Data"]
menu_utama = st.sidebar.selectbox("Mahasiswa", sub_menu)

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
        if nim.strip() == "" or nama.strip()  == "" or jk.strip() == "" or alamat.strip() == ""  or prodi.strip() == "":
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
    st.subheader("Tampilakan Data Mahasiswa")
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
        data_terpilih= cari_mahasiswa(pilih_nim)
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
            confirm  = st.checkbox("✔️ Ya, saya yakin")
            if st.button("Hapus"):
                if confirm:
                    hapus_mahasiswa(pilih_nim)
                    st.success("Data Mahasiswa berasil dihapus")
                else:
                    st.error("❌ Penghapusan dibatalkan, mohon centang konfirmasi terlebih dahulu")