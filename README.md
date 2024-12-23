# UAS Pemrograman Web - Proyek Aplikasi Pengelolaan Fans Rimuru

## Deskripsi Proyek
Proyek ini adalah aplikasi berbasis web yang memungkinkan pengguna untuk mengisi formulir data diri sebagai penggemar Rimuru, termasuk nama, jenis kelamin, minat, dan tingkat fandom. Data yang disubmit akan disimpan dalam basis data dan ditampilkan dalam tabel di halaman baru. Aplikasi ini menggunakan teknologi HTML, CSS, JavaScript, PHP, dan MySQL.

## Struktur Proyek
- `index.php`
- `styles.css`
- `script.js`
- `README.md`

Aplikasi ini memiliki form dengan 4 elemen input:
1. **Text Input** untuk memasukkan nama pengguna.
2. **Radio Button** untuk memilih jenis kelamin.
3. **Checkboxes** untuk memilih minat pengguna (Anime, Manga, Games).
4. **Select Dropdown** untuk memilih tingkat fandom.

### Manipulasi DOM dengan JavaScript
- Menampilkan pesan kesalahan saat input tidak valid.
- Menambahkan event listener untuk menangani form submit.

### Tiga event yang di-handle oleh JavaScript dalam proyek ini adalah:
1. **Submit Form**: Saat form disubmit, data akan divalidasi.
2. **Validasi Input**: Sebelum data diproses oleh PHP, validasi dilakukan pada sisi client menggunakan JavaScript untuk memastikan semua input terisi dengan benar.
3. **Event Button**: Pada tombol submit, JavaScript akan menangani pengiriman data ke server.

Validasi mencakup pemeriksaan apakah semua field diisi dan memastikan bahwa pengguna memilih jenis kelamin serta tingkat fandom.

### Pengolahan Data dengan PHP
Data dari form akan dikirimkan menggunakan metode POST. PHP akan memproses data ini dengan cara berikut:
- Menyaring dan memvalidasi data untuk memastikan tidak ada data yang kosong atau berbahaya.
- Menggunakan PDO untuk menghubungkan dan menyimpan data ke database MySQL, termasuk informasi tentang jenis browser dan alamat IP pengguna.

### OOP dalam PHP
Aplikasi ini mengimplementasikan Object-Oriented Programming (OOP) dengan membuat sebuah class **Fans** yang menangani dua metode utama:
- `saveData($data)`: Menyimpan data penggemar ke database.
- `getData()`: Mengambil data penggemar dari database untuk ditampilkan di halaman baru.

Kedua metode ini digunakan untuk memproses dan menampilkan data dalam aplikasi.

### Struktur Tabel Database
Database `rimuru_fans` memiliki tabel `fans` dengan struktur sebagai berikut:

```sql
CREATE TABLE fans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    interests TEXT,
    fandom_level VARCHAR(50) NOT NULL,
    browser VARCHAR(255) NOT NULL,
    ip_address VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
