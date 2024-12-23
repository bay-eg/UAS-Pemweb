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
```
## Koneksi ke Database
Koneksi ke database menggunakan PDO:

```php
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);
```
Data yang diinputkan pengguna disimpan menggunakan SQL INSERT query dalam tabel fans. Pengguna dapat melihat data yang telah dimasukkan pada halaman data.php setelah proses submit.
##Sesion Management
## Session Management
Fungsi `session_start()` digunakan untuk memulai sesi, dan informasi pengguna disimpan dalam session untuk memberikan pesan setelah data berhasil disubmit. Pesan ini akan ditampilkan di halaman `data.php` menggunakan PHP `$_SESSION`:

```php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
```
## Instalasi dan Penggunaan

1. **Unduh atau Clone Repository**: Unduh atau clone repositori dari GitHub.
2. **Buat Database**: Jalankan SQL script untuk membuat tabel di MySQL:

    ```sql
    CREATE DATABASE rimuru_fans;
    ```

3. **Konfigurasi Koneksi Database**: Sesuaikan detail koneksi database pada file `index.php` dan `data.php` jika diperlukan.
4. **Jalankan Aplikasi**: Buka file `index.php` di browser untuk mengisi form, dan data akan ditampilkan di halaman `data.php` setelah submit.

## Penutup

Proyek ini adalah contoh pengembangan aplikasi web dengan menggabungkan berbagai teknik pemrograman sisi klien dan server menggunakan HTML, JavaScript, PHP, dan MySQL.

