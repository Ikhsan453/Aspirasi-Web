# USER MANUAL - SISTEM ASPIRASI WEB
## Platform Pelaporan Sarana dan Prasarana Sekolah

---

## 📋 DAFTAR ISI

1. [Tentang Sistem](#tentang-sistem)
2. [Akses Sistem](#akses-sistem)
3. [Panduan untuk Siswa](#panduan-untuk-siswa)
4. [Panduan untuk Admin](#panduan-untuk-admin)
5. [FAQ (Pertanyaan Umum)](#faq-pertanyaan-umum)
6. [Troubleshooting](#troubleshooting)
7. [Kontak Support](#kontak-support)

---

## 🎯 TENTANG SISTEM

### Apa itu Sistem Aspirasi Web?

Sistem Aspirasi Web adalah platform digital yang memudahkan siswa untuk melaporkan kerusakan atau masalah sarana dan prasarana sekolah. Sistem ini memungkinkan:

- ✅ Pelaporan masalah secara online tanpa perlu login
- ✅ Upload foto sebagai bukti pendukung
- ✅ Tracking status penanganan secara real-time
- ✅ Riwayat lengkap setiap Aspirasi
- ✅ Kategorisasi masalah untuk penanganan lebih cepat

### Fitur Utama

#### Untuk Siswa:
- Membuat Aspirasi baru dengan mudah
- Melampirkan foto bukti
- Cek status Aspirasi menggunakan NIS
- Melihat riwayat perubahan status
- Membaca feedback dari admin

#### Untuk Admin:
- Dashboard statistik lengkap
- Manajemen data siswa
- Manajemen kategori Aspirasi
- Update status Aspirasi
- Memberikan feedback kepada pelapor
- Tracking riwayat perubahan

---

## 🌐 AKSES SISTEM

### URL Akses
```
http://localhost:8000
```
(Sesuaikan dengan domain yang digunakan sekolah)

### Browser yang Didukung
- ✅ Google Chrome (Recommended)
- ✅ Mozilla Firefox
- ✅ Microsoft Edge
- ✅ Safari

### Persyaratan Sistem
- Koneksi internet stabil
- Browser modern dengan JavaScript enabled
- Resolusi layar minimal 1024x768

---

## 👨‍🎓 PANDUAN UNTUK SISWA

### A. MEMBUAT ASPIRASI BARU

#### Langkah 1: Akses Halaman Beranda
1. Buka browser dan akses URL sistem
2. Anda akan melihat halaman beranda dengan informasi sistem
3. Klik tombol **"Buat Aspirasi Baru"** (tombol hijau besar)

#### Langkah 2: Isi Data Identitas
1. **Nomor Induk Siswa (NIS)**
   - Masukkan NIS Anda (10 digit)
   - Sistem akan otomatis memverifikasi NIS
   - Jika valid, akan muncul informasi kelas dan jurusan Anda
   - ⚠️ **PENTING**: NIS harus sudah terdaftar oleh admin

2. **Verifikasi NIS**
   ```
   ✅ NIS Valid! Kelas XII IPA 1
   ⚠️ NIS tidak terdaftar. Hubungi admin untuk registrasi.
   ```

#### Langkah 3: Isi Detail Aspirasi
1. **Kategori**
   - Pilih kategori yang sesuai dengan masalah
   - Contoh: Kerusakan Meja/Kursi, Kerusakan Pintu/Jendela, dll.

2. **Lokasi Kejadian**
   - Tulis lokasi spesifik (maksimal 50 karakter)
   - Contoh: "Ruang Kelas XII IPA 1"
   - Contoh: "Toilet Lantai 2 Gedung A"

3. **Keterangan Detail**
   - Jelaskan masalah secara detail
   - Semakin jelas, semakin cepat ditangani
   - Contoh: "Kursi nomor 5 dari depan patah pada bagian sandaran. Berbahaya jika digunakan."

#### Langkah 4: Upload Foto (Opsional)
1. Klik area upload atau drag & drop foto
2. **Persyaratan Foto:**
   - Format: JPG, PNG, GIF
   - Ukuran maksimal: 2MB
   - Foto harus jelas dan relevan
3. Preview foto akan muncul setelah upload
4. Klik "Hapus Foto" jika ingin mengganti

#### Langkah 5: Submit Aspirasi
1. Periksa kembali semua data yang diisi
2. Klik tombol **"Kirim Aspirasi"**
3. Tunggu proses pengiriman
4. Anda akan diarahkan ke halaman sukses

#### Langkah 6: Simpan Nomor Tracking
1. Setelah berhasil, Anda akan mendapat **ID Pelaporan**
2. Catat nomor ini untuk tracking status
3. Contoh: **#12345**

### B. CEK STATUS ASPIRASI

#### Cara 1: Dari Halaman Beranda
1. Klik tombol **"Cek Status Aspirasi"** (tombol biru)
2. Masukkan NIS Anda
3. Klik tombol **"Cari"**

#### Cara 2: Dari Menu Navigasi
1. Klik menu **"Cek Status"** di navigation bar
2. Masukkan NIS Anda
3. Klik tombol **"Cari"**

#### Membaca Status Aspirasi

**Status yang Tersedia:**

1. **🟡 Menunggu**
   - Aspirasi baru masuk
   - Belum direview admin
   - Biasanya diproses dalam 1-2 hari kerja

2. **🔵 Proses**
   - Aspirasi sedang ditangani
   - Admin sudah mereview dan mengambil tindakan
   - Cek feedback untuk info lebih lanjut

3. **🟢 Selesai**
   - Masalah sudah ditangani
   - Aspirasi ditutup
   - Baca feedback untuk hasil penanganan

#### Melihat Detail Aspirasi
1. Pada daftar Aspirasi, klik tombol **"👁️ Detail"**
2. Modal akan muncul dengan informasi lengkap:
   - ID Pelaporan
   - Tanggal laporan
   - Kategori dan lokasi
   - Keterangan detail
   - Foto (jika ada)
   - Status terkini
   - Feedback dari admin
   - Riwayat perubahan status

### C. TIPS MEMBUAT ASPIRASI EFEKTIF

#### ✅ DO (Lakukan):
- Gunakan NIS yang valid dan terdaftar
- Pilih kategori yang tepat
- Tulis lokasi dengan spesifik
- Jelaskan masalah secara detail
- Lampirkan foto yang jelas
- Gunakan bahasa yang sopan dan jelas

#### ❌ DON'T (Jangan):
- Membuat Aspirasi palsu atau bercanda
- Menggunakan NIS orang lain
- Menulis keterangan yang tidak jelas
- Upload foto yang tidak relevan
- Membuat Aspirasi duplikat untuk masalah yang sama

---

## 👨‍💼 PANDUAN UNTUK ADMIN

### A. LOGIN ADMIN

#### Langkah Login:
1. Akses URL: `http://localhost:8000/admin/login`
2. Masukkan kredensial:
   ```
   Username: admin
   Password: admin123
   ```
3. Klik tombol **"Login"**
4. Anda akan diarahkan ke Dashboard Admin

#### Keamanan:
- ⚠️ Jangan share password dengan siapapun
- 🔒 Selalu logout setelah selesai
- 🔑 Ganti password default segera

### B. DASHBOARD ADMIN

#### Statistik Utama
Dashboard menampilkan 4 kartu statistik:

1. **Total Aspirasi**
   - Jumlah semua Aspirasi yang masuk
   - Semua status (Menunggu, Proses, Selesai)

2. **Menunggu Review**
   - Aspirasi baru yang belum ditangani
   - ⚠️ Prioritas utama untuk direview

3. **Dalam Proses**
   - Aspirasi yang sedang ditangani
   - Perlu monitoring progress

4. **Selesai Ditangani**
   - Aspirasi yang sudah selesai
   - Sudah ditutup

#### Aspirasi Terbaru
- Menampilkan 5 Aspirasi terbaru
- Informasi: ID, Tanggal, NIS, Kategori, Lokasi, Status
- Klik **"Detail"** untuk melihat lengkap
- Klik **"Lihat Semua Aspirasi"** untuk daftar lengkap

#### Statistik Kategori
- Grafik progress bar per kategori
- Jumlah Aspirasi per kategori
- Persentase dari total
- Breakdown status (Menunggu, Proses, Selesai)

### C. MANAJEMEN SISWA

#### Melihat Daftar Siswa
1. Klik menu **"Data Siswa"** di sidebar
2. Tabel menampilkan: NIS, Kelas, Jurusan, Total Aspirasi
3. Gunakan pagination untuk navigasi

#### Menambah Siswa Baru
1. Klik tombol **"+ Tambah Siswa"** (hijau)
2. Isi form:
   - **NIS**: 10 digit, unik
   - **Kelas**: Contoh: XII, XI, X
   - **Jurusan**: Contoh: IPA 1, IPS 2, TKJ
3. Klik **"Simpan"**

#### Mengedit Data Siswa
1. Klik tombol **"✏️ Edit"** pada siswa yang ingin diubah
2. Update data yang diperlukan
3. Klik **"Update"**

#### Menghapus Siswa
1. Klik tombol **"🗑️ Hapus"**
2. Konfirmasi penghapusan
3. ⚠️ **PERHATIAN**: 
   - Semua Aspirasi siswa akan ikut terhapus
   - Tindakan ini tidak dapat dibatalkan

### D. MANAJEMEN KATEGORI

#### Melihat Daftar Kategori
1. Klik menu **"Kategori"** di sidebar
2. Tabel menampilkan: Nama Kategori, Total Aspirasi, Status
3. Lihat statistik per kategori

#### Menambah Kategori Baru
1. Klik tombol **"+ Tambah Kategori"** (hijau)
2. Isi **Nama Kategori**
   - Contoh: "Kerusakan AC"
   - Contoh: "Kerusakan Proyektor"
3. Klik **"Simpan"**

#### Mengedit Kategori
1. Klik tombol **"✏️ Edit"**
2. Update nama kategori
3. Klik **"Update"**

#### Menghapus Kategori
1. Klik tombol **"🗑️ Hapus"**
2. Konfirmasi penghapusan
3. ⚠️ **PERHATIAN**: 
   - Aspirasi dengan kategori ini akan ikut terhapus
   - Pastikan tidak ada Aspirasi aktif

### E. MANAJEMEN ASPIRASI

#### Melihat Semua Aspirasi
1. Klik menu **"Aspirasi"** di sidebar
2. Filter berdasarkan:
   - Status (Semua, Menunggu, Proses, Selesai)
   - Kategori
   - Tanggal
3. Gunakan search untuk cari NIS atau ID tertentu

#### Melihat Detail Aspirasi
1. Klik tombol **"👁️ Detail"** pada Aspirasi
2. Informasi yang ditampilkan:
   - Data pelapor (NIS, Kelas, Jurusan)
   - Detail Aspirasi (Kategori, Lokasi, Keterangan)
   - Foto bukti (jika ada)
   - Status terkini
   - Riwayat perubahan status

#### Update Status Aspirasi

**Langkah-langkah:**

1. **Buka Detail Aspirasi**
   - Klik tombol "Detail" pada Aspirasi yang ingin diupdate

2. **Pilih Status Baru**
   - **Menunggu → Proses**: Saat mulai menangani
   - **Proses → Selesai**: Saat masalah sudah ditangani
   - **Menunggu → Selesai**: Jika tidak perlu proses (misal: duplikat)

3. **Tulis Feedback**
   - Jelaskan tindakan yang diambil
   - Berikan informasi progress
   - Gunakan bahasa yang sopan dan jelas
   
   **Contoh Feedback:**
   ```
   Status: Proses
   Feedback: "Kursi yang rusak sudah dilaporkan ke bagian sarana. 
   Estimasi perbaikan 2-3 hari kerja."
   ```
   
   ```
   Status: Selesai
   Feedback: "Kursi sudah diperbaiki dan dapat digunakan kembali. 
   Terima kasih atas laporannya."
   ```

4. **Simpan Perubahan**
   - Klik tombol **"Update Status"**
   - Sistem akan mencatat perubahan ke riwayat
   - Siswa dapat melihat update ini

#### Menghapus Aspirasi
1. Klik tombol **"🗑️ Hapus"** pada detail Aspirasi
2. Konfirmasi penghapusan
3. ⚠️ **Gunakan dengan hati-hati**
   - Hanya untuk Aspirasi spam/tidak valid
   - Semua riwayat akan terhapus

### F. BEST PRACTICES UNTUK ADMIN

#### Penanganan Aspirasi Prioritas

**Prioritas Tinggi:**
- Aspirasi keamanan (pintu rusak, kaca pecah)
- Aspirasi yang mengganggu KBM
- Aspirasi dengan foto bukti jelas

**Prioritas Sedang:**
- Kerusakan minor yang tidak mengganggu KBM
- Aspirasi tanpa foto

**Prioritas Rendah:**
- Saran perbaikan
- Aspirasi duplikat

#### Timeline Response
- **Menunggu → Proses**: Maksimal 2 hari kerja
- **Proses → Selesai**: Tergantung jenis kerusakan
- **Update Feedback**: Minimal 1x dalam 3 hari

#### Tips Menulis Feedback
✅ **Good Feedback:**
```
"Kerusakan AC sudah dilaporkan ke teknisi. Perbaikan dijadwalkan 
tanggal 15 Februari 2026. Sementara waktu, mohon gunakan ruangan 
lain untuk KBM. Terima kasih atas laporannya."
```

❌ **Bad Feedback:**
```
"Sudah diproses."
```

---

## ❓ FAQ (PERTANYAAN UMUM)

### Untuk Siswa

**Q: Apakah saya perlu membuat akun untuk melaporkan?**
A: Tidak. Sistem ini tidak memerlukan login. Cukup gunakan NIS yang sudah terdaftar.

**Q: NIS saya tidak terdaftar, apa yang harus dilakukan?**
A: Hubungi admin atau guru untuk mendaftarkan NIS Anda ke sistem.

**Q: Berapa lama Aspirasi saya akan ditanggapi?**
A: Biasanya dalam 1-2 hari kerja. Aspirasi prioritas tinggi akan lebih cepat.

**Q: Apakah saya bisa mengedit Aspirasi setelah dikirim?**
A: Tidak. Pastikan semua data sudah benar sebelum submit. Jika ada kesalahan, buat Aspirasi baru atau hubungi admin.

**Q: Foto saya gagal diupload, kenapa?**
A: Pastikan:
- Ukuran file maksimal 2MB
- Format: JPG, PNG, atau GIF
- Koneksi internet stabil

**Q: Apakah saya bisa melaporkan masalah yang sama berkali-kali?**
A: Tidak disarankan. Cek dulu status Aspirasi sebelumnya. Jika belum ditangani, tunggu atau hubungi admin.

**Q: Bagaimana cara mengetahui Aspirasi saya sudah selesai?**
A: Cek status menggunakan NIS. Status "Selesai" berarti sudah ditangani. Baca feedback untuk detailnya.

### Untuk Admin

**Q: Bagaimana cara mengganti password admin?**
A: Saat ini belum ada fitur change password di UI. Hubungi developer untuk update password di database.

**Q: Apakah bisa ada lebih dari 1 admin?**
A: Ya. Hubungi developer untuk menambahkan admin baru melalui seeder atau database.

**Q: Bagaimana cara export data Aspirasi?**
A: Fitur export belum tersedia. Saat ini data dapat dilihat dan dikelola melalui dashboard.

**Q: Apakah ada notifikasi untuk Aspirasi baru?**
A: Saat ini belum ada. Admin perlu cek dashboard secara berkala.

**Q: Bagaimana cara backup data?**
A: Backup database MySQL secara berkala. Hubungi IT support untuk prosedur backup.

---

## 🔧 TROUBLESHOOTING

### Masalah Umum dan Solusi

#### 1. Halaman Tidak Dapat Diakses

**Gejala:**
- Error "This site can't be reached"
- Halaman tidak loading

**Solusi:**
1. Pastikan server Laravel sudah running
   ```bash
   php artisan serve
   ```
2. Cek koneksi internet
3. Pastikan URL benar: `http://localhost:8000`
4. Coba clear browser cache (Ctrl+Shift+Del)

#### 2. NIS Tidak Terverifikasi

**Gejala:**
- Muncul pesan "NIS tidak terdaftar"

**Solusi:**
1. Pastikan NIS sudah didaftarkan oleh admin
2. Cek penulisan NIS (10 digit, tanpa spasi)
3. Hubungi admin untuk registrasi

#### 3. Foto Gagal Diupload

**Gejala:**
- Error saat upload foto
- Foto tidak muncul di preview

**Solusi:**
1. Cek ukuran file (maksimal 2MB)
2. Pastikan format JPG, PNG, atau GIF
3. Compress foto jika terlalu besar
4. Coba foto lain untuk test

#### 4. Login Admin Gagal

**Gejala:**
- Error "Invalid credentials"
- Tidak bisa masuk dashboard

**Solusi:**
1. Pastikan username dan password benar
   - Default: admin / admin123
2. Cek CAPS LOCK
3. Clear browser cache
4. Coba browser lain

#### 5. Data Tidak Muncul di Dashboard

**Gejala:**
- Dashboard kosong
- Statistik menunjukkan 0

**Solusi:**
1. Pastikan database sudah di-migrate
   ```bash
   php artisan migrate
   ```
2. Jalankan seeder
   ```bash
   php artisan db:seed
   ```
3. Refresh halaman (F5)
4. Clear cache
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

#### 6. Foto Tidak Muncul di Detail

**Gejala:**
- Icon warning "Foto tidak dapat dimuat"
- Broken image

**Solusi:**
1. Pastikan storage link sudah dibuat
   ```bash
   php artisan storage:link
   ```
2. Cek file foto ada di `storage/app/public/aspirasi/`
3. Cek permission folder storage

#### 7. Error 500 Internal Server Error

**Gejala:**
- Halaman error 500
- Aplikasi crash

**Solusi:**
1. Cek log error di `storage/logs/laravel.log`
2. Pastikan .env sudah dikonfigurasi dengan benar
3. Cek koneksi database
4. Clear cache:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

#### 8. Session Expired / Logout Otomatis

**Gejala:**
- Admin logout sendiri
- Harus login berulang kali

**Solusi:**
1. Cek konfigurasi session di `.env`
2. Pastikan `SESSION_DRIVER=cookie`
3. Clear browser cookies
4. Tingkatkan `SESSION_LIFETIME` di `.env`

---

## 📞 KONTAK SUPPORT

### Tim IT Support Sekolah

**Untuk Bantuan Teknis:**
- 📧 Email: it.support@sekolah.sch.id
- 📱 WhatsApp: +62 xxx-xxxx-xxxx
- 🏢 Ruang IT: Gedung A Lantai 1

**Jam Operasional:**
- Senin - Jumat: 07:00 - 15:00 WIB
- Sabtu: 07:00 - 12:00 WIB
- Minggu & Libur: Tutup

### Developer Contact

**Untuk Bug Report atau Feature Request:**
- 📧 Email: khanby1.f@gmail.com
- 🐙 GitHub: https://github.com/Ikhsan453/Aspirasi-Web

---

## 📝 CATATAN PENTING

### Untuk Siswa:
1. ✅ Gunakan sistem dengan bijak dan bertanggung jawab
2. ✅ Laporkan masalah yang benar-benar terjadi
3. ✅ Berikan informasi sejelas mungkin
4. ✅ Cek status Aspirasi secara berkala
5. ❌ Jangan membuat laporan palsu atau bercanda

### Untuk Admin:
1. ✅ Tangani Aspirasi sesuai prioritas
2. ✅ Berikan feedback yang informatif
3. ✅ Update status secara berkala
4. ✅ Backup data secara rutin
5. ✅ Jaga kerahasiaan password
6. ❌ Jangan hapus Aspirasi tanpa alasan jelas

---

## 📊 CHANGELOG

### Version 1.0.0 (24 Februari 2026)
- ✅ Sistem Aspirasi tanpa login untuk siswa
- ✅ Dashboard admin dengan statistik lengkap
- ✅ Manajemen siswa, kategori, dan Aspirasi
- ✅ Upload foto pendukung
- ✅ Tracking status real-time
- ✅ Riwayat perubahan status
- ✅ Feedback system
- ✅ Responsive design dengan Bootstrap
- ✅ Modern UI dengan animasi

---

## 📄 LISENSI

Sistem Aspirasi Web
Copyright © 2026 - Sekolah [Nama Sekolah]

Dikembangkan oleh: Ikhsan
GitHub: https://github.com/Ikhsan453/Aspirasi-Web

---

**Terima kasih telah menggunakan Sistem Aspirasi Web!**

Untuk pertanyaan lebih lanjut, silakan hubungi tim IT Support sekolah.

---

*Dokumen ini terakhir diupdate: 25 Februari 2026*
