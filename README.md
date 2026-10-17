# Todo List App — PHP & MySQL

Aplikasi Todo List sederhana berbasis PHP, MySQL, HTML, dan CSS. Aplikasi ini memungkinkan pengguna mengelola daftar tugas melalui antarmuka web, dengan data yang disimpan di database MySQL.

## Fitur

- Create — menambahkan tugas baru.
- Read — menampilkan daftar tugas dan statistik.
- Update — mengubah nama tugas.
- Status tugas — menandai tugas selesai atau mengembalikannya ke status belum selesai.
- Delete — menghapus satu tugas.

## Struktur Folder

```text
todo-list/
├── index.php
├── README.md
├── php/
│   ├── db.php
│   ├── functions.php
│   └── process.php
├── views/
│   └── index.php
└── css/
    └── style.css
```

## Instalasi

### 1. Simpan proyek

Letakkan folder proyek di direktori web server XAMPP:

```text
C:\xampp\htdocs\todo-list\
```

### 2. Jalankan XAMPP

Buka XAMPP Control Panel, lalu jalankan:

- Apache
- MySQL

### 3. Buat database

Buka phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Pilih tab **SQL**, lalu jalankan:

```sql
CREATE DATABASE IF NOT EXISTS todo_list_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE todo_list_db;

CREATE TABLE IF NOT EXISTS tasks (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(200) NOT NULL,
    is_completed TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 4. Konfigurasi koneksi database

Buka `php/db.php` dan sesuaikan konfigurasi dengan MySQL lokal:

```php
$host = 'localhost';
$dbname = 'todo_list_db';
$username = 'root';
$password = '';
```

Pada konfigurasi XAMPP standar, akun `root` biasanya tidak menggunakan password. Jika instalasi lokal Anda menggunakan password, isi variabel `$password` dengan nilai yang sesuai.

### 5. Jalankan aplikasi

Buka alamat berikut di browser:

```text
http://localhost/todo-list/
```
