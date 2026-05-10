#include <iostream>
#include <string>
#include <vector>

using namespace std;

struct Pemesanan {
    string nama;
    string tanggalBooking;
    string tanggalPernikahan;
    int jumlahTamu;
    string lokasiPernikahan;
    string nomorTelpon;
    string tipePaket;
    string catatanTambahan;
    long long harga;
    long long dp;
    long long kembalian;
};

class WeddingOrganizer {
private:
    vector<Pemesanan> pemesananList;

public:
    bool isValidInput(const string& str, bool allowSlash = false, bool allowPlus = false) {
        if (str.empty())
            return false;

        for (size_t i = 0; i < str.length(); ++i) {

            if (i == 0 && allowPlus && str[i] == '+')
                continue;

            if (allowSlash && str[i] == '/')
                continue;

            if (str[i] < '0' || str[i] > '9')
                return false;
        }

        return true;
    }

    void inputDetails() {
        Pemesanan newPemesanan;

        cout << '\n'
             << "                                ELLISTON WEDDING ORGANIZER                           \n"
             << endl;

        cout << "                                JL. MEET YOUR LOVE NO.9959                           "
             << endl;

        cout << "                                       085220784034                                  "
             << endl;

        cout << "*************************************************************************************"
             << endl;

        cout << '\n'
             << "                    === Booking Elliston Wedding Organizer ===                       \n"
             << endl;

        do {
            cout << "Tanggal Booking (DD/MM/YYYY): ";
            cin >> newPemesanan.tanggalBooking;

            if (!isValidInput(newPemesanan.tanggalBooking, true)) {
                cout << "Format tanggal tidak valid. Gunakan format DD/MM/YYYY."
                     << endl;
            }

        } while (!isValidInput(newPemesanan.tanggalBooking, true));

        cout << "Nama Pelanggan: ";
        cin.ignore();
        getline(cin, newPemesanan.nama);

        do {
            cout << "Tanggal Pernikahan (DD/MM/YYYY): ";
            cin >> newPemesanan.tanggalPernikahan;

            if (!isValidInput(newPemesanan.tanggalPernikahan, true)) {
                cout << "Format tanggal tidak valid. Gunakan format DD/MM/YYYY."
                     << endl;
            }

        } while (!isValidInput(newPemesanan.tanggalPernikahan, true));

        cout << "Lokasi Pernikahan: ";
        cin.ignore();
        getline(cin, newPemesanan.lokasiPernikahan);

        do {
            cout << "Nomor Telpon: ";
            cin >> newPemesanan.nomorTelpon;

            if (!isValidInput(newPemesanan.nomorTelpon, false, true)) {
                cout << "Format nomor tidak valid."
                     << endl;
            }

        } while (!isValidInput(newPemesanan.nomorTelpon, false, true));

        cout << "Jumlah Tamu: ";
        cin >> newPemesanan.jumlahTamu;

        cout << '\n'
             << "Pilihan Paket:" << endl;

        cout << "1. Dreamy" << endl;
        cout << "2. Dreams" << endl;
        cout << "3. Coral" << endl;
        cout << "4. Plum Murray" << endl;

        cout << '\n'
             << "Masukkan pilihan paket: ";

        int choice;
        cin >> choice;

        switch (choice) {

            case 1:
                newPemesanan.tipePaket = "Dreamy";
                newPemesanan.harga = 400000000;

                if (newPemesanan.jumlahTamu > 300) {
                    newPemesanan.harga +=
                        (newPemesanan.jumlahTamu - 300) * 250000;
                }
                break;

            case 2:
                newPemesanan.tipePaket = "Dreams";
                newPemesanan.harga = 250000000;

                if (newPemesanan.jumlahTamu > 200) {
                    newPemesanan.harga +=
                        (newPemesanan.jumlahTamu - 200) * 175000;
                }
                break;

            case 3:
                newPemesanan.tipePaket = "Coral";
                newPemesanan.harga = 90000000;

                if (newPemesanan.jumlahTamu > 70) {
                    newPemesanan.harga +=
                        (newPemesanan.jumlahTamu - 70) * 125000;
                }
                break;

            case 4:
                newPemesanan.tipePaket = "Plum Murray";

                cout << "Masukkan Harga Paket: Rp ";
                cin >> newPemesanan.harga;
                break;

            default:
                cout << "Pilihan tidak valid. Menggunakan paket Dreamy."
                     << endl;

                newPemesanan.tipePaket = "Dreamy";
                newPemesanan.harga = 400000000;
                break;
        }

        cout << "Jumlah DP: Rp ";
        cin >> newPemesanan.dp;

        newPemesanan.kembalian =
            newPemesanan.harga - newPemesanan.dp;

        cout << "Catatan Tambahan (Jika ada): ";
        cin.ignore();
        getline(cin, newPemesanan.catatanTambahan);

        pemesananList.push_back(newPemesanan);

        cout << '\n'
             << "====================================================================="
             << endl;

        cout << "Terima kasih telah mempercayai Elliston Wedding Organizer."
             << endl;

        cout << "Instagram : @ellistonwedding"
             << endl;

        cout << "Whatsapp  : 085220784034"
             << endl;

        cout << "Have a nice day!"
             << endl;

        cout << "====================================================================="
             << endl;
    }

    void displaySummary() {

        cout << '\n'
             << "                                ELLISTON WEDDING ORGANIZER                           \n"
             << endl;

        cout << "                                JL. MEET YOUR LOVE NO.9959                           "
             << endl;

        cout << "                                       085220784034                                  "
             << endl;

        cout << "*************************************************************************************"
             << endl;

        cout << '\n'
             << "                         === RINGKASAN PEMESANAN ===                                 \n"
             << endl;

        long long totalHarga = 0;

        for (size_t i = 0; i < pemesananList.size(); i++) {

            cout << "Pemesanan #" << (i + 1)
                 << endl;

            cout << "====================================================================="
                 << endl;

            cout << "Tanggal Booking : "
                 << pemesananList[i].tanggalBooking
                 << endl;

            cout << "Nama Pelanggan  : "
                 << pemesananList[i].nama
                 << endl;

            cout << "Tanggal Acara   : "
                 << pemesananList[i].tanggalPernikahan
                 << endl;

            cout << "Lokasi          : "
                 << pemesananList[i].lokasiPernikahan
                 << endl;

            cout << "Nomor Telpon    : "
                 << pemesananList[i].nomorTelpon
                 << endl;

            cout << "Jumlah Tamu     : "
                 << pemesananList[i].jumlahTamu
                 << endl;

            cout << "Tipe Paket      : "
                 << pemesananList[i].tipePaket
                 << endl;

            cout << "Harga           : Rp "
                 << pemesananList[i].harga
                 << endl;

            cout << "DP              : Rp "
                 << pemesananList[i].dp
                 << endl;

            cout << "Sisa Pembayaran : Rp "
                 << pemesananList[i].kembalian
                 << endl;

            cout << "Catatan         : "
                 << pemesananList[i].catatanTambahan
                 << endl;

            cout << "---------------------------------------------------------------------"
                 << endl;

            totalHarga += pemesananList[i].harga;
        }

        cout << "====================================================================="
             << endl;

        cout << "Total Harga Semua Pemesanan : Rp "
             << totalHarga
             << endl;

        cout << "====================================================================="
             << endl;
    }
};

int main() {

    WeddingOrganizer wo;

    int pilihan;
    char lanjut;

    cout << '\n'
         << "                                ELLISTON WEDDING ORGANIZER                           \n"
         << endl;

    cout << "                                JL. MEET YOUR LOVE NO.9959                           "
         << endl;

    cout << "                                       085220784034                                  "
         << endl;

    cout << "*************************************************************************************"
         << endl;

    do {

        cout << '\n'
             << "1. Tentang Elliston Wedding Organizer"
             << endl;

        cout << "2. Detail Paket"
             << endl;

        cout << "3. Booking Elliston WO"
             << endl;

        cout << "4. Rincian Pemesanan"
             << endl;

        cout << "5. Keluar"
             << endl;

        cout << '\n'
             << "Masukkan pilihan: ";

        cin >> pilihan;

        switch (pilihan) {

            case 1:

                cout << '\n'
                     << "Menghadirkan keagungan cinta dalam setiap detail."
                     << endl;

                cout << "Dengan sentuhan klasik dan elegan,"
                     << endl;

                cout << "kami merancang pernikahan impian anda."
                     << endl;

                cout << '\n'
                     << "Layanan yang tersedia:"
                     << endl;

                cout << "1. Konsultasi dan perencanaan pernikahan"
                     << endl;

                cout << "2. Konsep dan desain pernikahan"
                     << endl;

                cout << "3. Pemilihan venue dan vendor"
                     << endl;

                cout << "4. Koordinasi acara pada hari H"
                     << endl;

                cout << "5. Dekorasi dan tata bunga"
                     << endl;

                cout << "6. Catering dan minuman"
                     << endl;

                cout << "7. Hiburan dan musik"
                     << endl;

                cout << "8. Dokumentasi pernikahan"
                     << endl;

                cout << '\n'
                     << "Instagram : @ellistonwedding"
                     << endl;

                cout << "Whatsapp  : 085220784034"
                     << endl;

                break;

            case 2:

                cout << '\n'
                     << "================ DETAIL PAKET ================"
                     << endl;

                cout << '\n'
                     << "1. Paket Dreamy"
                     << endl;

                cout << "Harga : Rp 400.000.000"
                     << endl;

                cout << "Maksimal 300 tamu"
                     << endl;

                cout << "Tambahan tamu : Rp 250.000/orang"
                     << endl;

                cout << '\n'
                     << "2. Paket Dreams"
                     << endl;

                cout << "Harga : Rp 250.000.000"
                     << endl;

                cout << "Maksimal 200 tamu"
                     << endl;

                cout << "Tambahan tamu : Rp 175.000/orang"
                     << endl;

                cout << '\n'
                     << "3. Paket Coral"
                     << endl;

                cout << "Harga : Rp 90.000.000"
                     << endl;

                cout << "Maksimal 70 tamu"
                     << endl;

                cout << "Tambahan tamu : Rp 125.000/orang"
                     << endl;

                cout << '\n'
                     << "4. Paket Plum Murray"
                     << endl;

                cout << "Harga mulai dari Rp 100.000.000"
                     << endl;

                cout << "Konsep bebas sesuai keinginan pelanggan"
                     << endl;

                cout << '\n'
                     << "DP minimal 50%"
                     << endl;

                break;

            case 3:

                wo.inputDetails();
                break;

            case 4:

                wo.displaySummary();
                break;

            case 5:

                cout << '\n'
                     << "Terima kasih telah menggunakan Elliston Wedding Organizer."
                     << endl;

                return 0;

            default:

                cout << "Pilihan tidak valid."
                     << endl;
        }

        cout << '\n'
             << "Lanjut ke menu lain? (y/n): ";

        cin >> lanjut;

    } while ((lanjut == 'y' || lanjut == 'Y') && pilihan != 5);

    cout << '\n'
         << "Terima kasih telah menggunakan Elliston Wedding Organizer."
         << endl;

    return 0;
}
