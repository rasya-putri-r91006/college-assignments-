from fpdf import FPDF # type: ignore
import os 

#PDF MAHASISWA
def cetak_pdf(data, filename="daftar_mahasiswa.pdf"):
    pdf = FPDF(orientation='L', unit='mm', format='A4')
    pdf.add_page()
    pdf.set_font("Arial", "B", size=14)

    pdf.cell(300, 10, txt="DAFTAR MAHASISWA", ln=True, align='C')
    pdf.ln(10)

    # Header kolom
    pdf.set_font("Arial", "B", size=10)
    pdf.cell(25, 8, "NIM", 1, align='C')
    pdf.cell(60, 8, "NAMA MAHASISWA", 1, align='C')
    pdf.cell(30, 8, "JENIS KELAMIN", 1, align='C')
    pdf.cell(130, 8, "ALAMAT", 1, align='C')
    pdf.cell(35, 8, "PROGRAM STUDI", 1, align='C')
    pdf.ln()

    #isi data
    pdf.set_font("Arial", size=10)
    for row in data:
        pdf.cell(25, 8, row[0], 1)
        pdf.cell(60, 8, row[1], 1)
        pdf.cell(30, 8, row[2], 1, align='C')
        pdf.cell(130, 8, row[3], 1)
        pdf.cell(35, 8, row[4], 1, align='C')
        pdf.ln()
    
    filepath = os.path.join(".", filename)
    pdf.output(filepath)
    return filepath

# CETAK PDF DOSEN
def cetak_pdf_dosen(data, filename="daftar_dosen.pdf"):
    pdf = FPDF(orientation='L', unit='mm', format='A4')
    pdf.add_page()
    pdf.set_font("Arial", "B", size=14)

    pdf.cell(300, 10, txt="DAFTAR DOSEN", ln=True, align='C')
    pdf.ln(10)

    # Header kolom
    pdf.set_font("Arial", "B", size=10)
    pdf.cell(25, 8, "ID DOSEN", 1, align='C')
    pdf.cell(60, 8, "NAMA DOSEN", 1, align='C')
    pdf.cell(100, 8, "TEMPAT TANGGAL LAHIR", 1, align='C')
    pdf.cell(30, 8, "HOMEBASE", 1, align='C')
    pdf.cell(35, 8, "PROGRAM STUDI", 1, align='C')
    pdf.ln()

    #isi data
    pdf.set_font("Arial", size=10)
    for row in data:
        pdf.cell(25, 8, row[0], 1)
        pdf.cell(60, 8, row[1], 1)
        pdf.cell(100, 8, row[2], 1, align='C')
        pdf.cell(30, 8, row[3], 1)
        pdf.cell(35, 8, row[4], 1, align='C')
        pdf.ln()
    
    filepath = os.path.join(".", filename)
    pdf.output(filepath)
    return filepath

# PDF KARYAWAN
def cetak_pdf_karyawan(data, filename="daftar_karyawan.pdf"):
    pdf = FPDF(orientation='L', unit='mm', format='A4')
    pdf.add_page()
    pdf.set_font("Arial", "B", size=14)

    pdf.cell(300, 10, txt="DAFTAR KARYAWAN", ln=True, align='C')
    pdf.ln(10)

    # Header kolom
    pdf.set_font("Arial", "B", size=10)
    pdf.cell(30, 8, "NO KARYAWAN", 1, align='C')
    pdf.cell(100, 8, "NAMA KARYAWAN", 1, align='C')
    pdf.cell(40, 8, "STATUS KARYAWAN", 1, align='C')
    pdf.ln()

    #isi data
    pdf.set_font("Arial", size=10)
    for row in data:
        pdf.cell(30, 8, row[0], 1)
        pdf.cell(100, 8, row[1], 1)
        pdf.cell(40, 8, row[2], 1, align='C')
        pdf.ln()
    
    filepath = os.path.join(".", filename)
    pdf.output(filepath)
    return filepath

#MATA KULIAH
def cetak_pdf_mk(data, filename="daftar_mk.pdf"):
    pdf = FPDF(orientation='L', unit='mm', format='A4')
    pdf.add_page()
    pdf.set_font("Arial", "B", size=14)

    pdf.cell(300, 10, txt="DAFTAR MATA KULIAH", ln=True, align='C')
    pdf.ln(10)

    # Header kolom
    pdf.set_font("Arial", "B", size=10)
    pdf.cell(40, 8, "KODE MATA KULAIH", 1, align='C')
    pdf.cell(100, 8, "NAMA MATA KULIAH", 1, align='C')
    pdf.cell(30, 8, "JUMLAH SKS", 1, align='C')
    pdf.cell(30, 8, "SEMESTER", 1, align='C')
    pdf.cell(35, 8, "PROGRAM STUDI", 1, align='C')
    pdf.ln()

    #isi data
    pdf.set_font("Arial", size=10)
    for row in data:
        pdf.cell(40, 8, row[0], 1)
        pdf.cell(100, 8, row[1], 1)
        pdf.cell(30, 8, str(row[2]), 1, align='C')
        pdf.cell(30, 8, str(row[3]), 1)
        pdf.cell(35, 8, row[4], 1, align='C')
        pdf.ln()
    
    filepath = os.path.join(".", filename)
    pdf.output(filepath)
    return filepath