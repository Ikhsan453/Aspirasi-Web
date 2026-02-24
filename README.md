# SOAL P3
https://drive.google.com/drive/folders/1TEHD1LIbjr2dRCbYyx1JS9Pkcp1R34os?usp=sharing

# ERD ASPIRASI WEB
https://drive.google.com/file/d/1p5g4231F7wRAyepaq_UAmk7MNJkS6sN4/view?usp=sharing

<img width="882" height="1035" alt="ERD_AspirasiWeb" src="https://github.com/user-attachments/assets/3e8f079b-5808-4c34-9051-93976d8d9dd6" />
﻿# Sistem aspirasi Sarana Sekolah

Aplikasi web untuk mengelola aspirasi kerusakan sarana dan prasarana sekolah yang dibuat dengan Laravel.

## Fitur Utama

### Untuk Siswa:
- **Buat aspirasi**: Siswa dapat melaporkan kerusakan dengan detail lengkap
- **Upload Foto**: Sertakan foto sebagai bukti pendukung
- **Tracking Status**: Pantau perkembangan aspirasi secara real-time
- **Cek Status**: Lihat semua aspirasi yang pernah dibuat

### Untuk Admin:
- **Dashboard**: Statistik dan overview aspirasi
- **Kelola Kategori**: Manajemen kategori aspirasi
- **Kelola Siswa**: Manajemen data siswa
- **Kelola aspirasi**: Review dan update status aspirasi
- **Update Status**: Ubah status aspirasi (Menunggu → Proses → Selesai)
- **Feedback**: Berikan feedback untuk setiap aspirasi

## Struktur Database

Aplikasi ini menggunakan 5 tabel utama:
- `kategoris`: Menyimpan kategori aspirasi
- `siswas`: Data siswa pelapor
- `input_aspirasis`: Data aspirasi dari siswa
- `aspirasis`: Status dan feedback aspirasi
- `admins`: Data admin sistem

## Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd aspirasi-sarana-sekolah
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Build Assets**
   ```bash
   npm run build
   ```

8. **Start Server**
   ```bash
   php artisan serve
   ```

## Login Admin

Setelah menjalankan seeder, gunakan kredensial berikut untuk login admin:
- **Username**: admin
- **Password**: admin123

## Struktur Folder

```
app/
├── Http/Controllers/
│   ├── Admin/           # Controllers untuk admin
│   └── Student/         # Controllers untuk siswa
├── Models/              # Eloquent models
resources/views/
├── layouts/             # Layout templates
├── admin/               # Views untuk admin
│   ├── auth/           # Login admin
│   ├── kategori/       # Manajemen kategori
│   ├── siswa/          # Manajemen siswa
│   └── aspirasi/       # Manajemen aspirasi
└── student/            # Views untuk siswa
    └── aspirasi/      # Form dan status aspirasi
database/
├── migrations/         # Database migrations
└── seeders/           # Database seeders
```

## Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: SQLite (default), MySQL/PostgreSQL (opsional)
- **Authentication**: Laravel Auth dengan custom guard untuk admin

## Fitur Keamanan

- CSRF Protection pada semua form
- File upload validation (gambar saja, max 2MB)
- Input sanitization dan validation
- Separate authentication untuk admin dan siswa

## Cara Penggunaan

### Untuk Siswa:
1. Buka halaman utama aplikasi
2. Klik "Buat aspirasi"
3. Isi form dengan lengkap (NIS, kelas, jurusan, kategori, lokasi, keterangan)
4. Upload foto jika ada (opsional)
5. Submit aspirasi
6. Gunakan "Cek Status" untuk memantau perkembangan

### Untuk Admin:
1. Login melalui `/admin/login`
2. Akses dashboard untuk melihat statistik
3. Kelola kategori, siswa, dan aspirasi melalui menu sidebar
4. Update status aspirasi dan berikan feedback

## Kontribusi

Aplikasi ini dibuat untuk memenuhi kebutuhan sistem aspirasi sarana sekolah dengan struktur yang terorganisir dan mudah dikembangkan lebih lanjut.

## Lisensi

Open source - silakan digunakan dan dikembangkan sesuai kebutuhan.
