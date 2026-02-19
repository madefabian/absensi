# Fitur Manajemen Rapat

## Ringkasan
Sekarang data rapat tidak hanya dipanggil dari database, tetapi juga dapat **disimpan ke database**. Sistem ini memungkinkan admin membuat rapat baru, menghasilkan QR code, dan melacak peserta yang absen.

## Yang Telah Ditambahkan

### 1. **Controller: RapatController** 
File: `app/Http/Controllers/RapatController.php`

Metode:
- `index()` - Menampilkan daftar semua rapat
- `create()` - Menampilkan form untuk membuat rapat baru
- `store()` - Menyimpan data rapat baru ke database
- `show()` - Menampilkan detail rapat, QR code, dan daftar peserta absen

### 2. **Views - Blade Template**

#### a. `resources/views/rapat/create.blade.php`
Form untuk membuat rapat baru dengan input:
- Judul Rapat
- Tanggal
- Jam Mulai
- Jam Selesai
- Lokasi

#### b. `resources/views/rapat/index.blade.php`
Menampilkan daftar semua rapat dalam bentuk tabel dengan:
- Judul
- Tanggal
- Waktu
- Lokasi
- Link ke detail rapat

#### c. `resources/views/rapat/show.blade.php`
Menampilkan detail rapat lengkap dengan:
- Informasi rapat (judul, tanggal, waktu, lokasi, status)
- **QR Code** yang dapat di-download atau di-print
- **URL Absensi** yang dapat disalin
- **Daftar peserta** yang telah absen dengan nama, jabatan, waktu scan, dan status

### 3. **Model: Rapat.php**
Ditambahkan relasi One-to-Many ke model Absensi:
```php
public function absensis()
{
    return $this->hasMany(Absensi::class);
}
```

### 4. **Routes**
Ditambahkan 4 route baru:
- `GET /rapats` - Daftar rapat (`rapat.index`)
- `GET /rapats/create` - Form buat rapat (`rapat.create`)
- `POST /rapats` - Simpan rapat baru (`rapat.store`)
- `GET /rapats/{rapat}` - Detail rapat (`rapat.show`)

### 5. **Welcome Page**
Diperbarui halaman utama dengan tombol akses cepat:
- Buat Rapat Baru
- Lihat Daftar Rapat

## Alur Kerja

1. **Admin/User membuat rapat baru:**
   - Klik "Buat Rapat Baru" di halaman utama
   - Isi form dengan detail rapat (judul, tanggal, waktu, lokasi)
   - Klik "Buat Rapat & Generate QR"
   - **Data rapat disimpan ke database**
   - QR Code otomatis digenerate dengan UUID token

2. **Rapat dapat dilihat di daftar:**
   - Ke halaman "Daftar Rapat"
   - Lihat semua rapat yang sudah dibuat
   - Klik "Lihat Detail & QR" untuk melihat detail

3. **Peserta scan QR dan absen:**
   - Peserta memindai QR code
   - Diisi nama dan jabatan
   - Data peserta absen **disimpan ke database** dengan referensi `rapat_id`

4. **Admin lihat hasil absensi:**
   - Di halaman detail rapat
   - Lihat daftar peserta yang telah absen
   - Informasi: nama, jabatan, waktu scan, status (hadir/telat)

## Database
Data yang tersimpan:

**Tabel `rapats`:**
- id
- judul
- tanggal
- jam_mulai
- jam_selesai
- lokasi
- qr_status (boolean)
- qr_token (UUID unik)
- created_at
- updated_at

**Tabel `absensis`:**
- id
- user_id (nullable)
- rapat_id (foreign key ke rapats)
- uuid
- waktu_scan
- status (hadir/telat)
- nama
- jabatan
- tanda_tangan

## Fitur Tambahan di Detail Rapat

- **Download QR Code** - Unduh sebagai PNG
- **Print QR Code** - Cetak langsung
- **Salin URL** - Salin URL absensi ke clipboard
- **Tabel peserta** - Lihat siapa saja yang sudah absen

## Teknologi yang Digunakan

- **Laravel 11** - Framework PHP
- **Tailwind CSS** - Styling
- **QRCode.js** - Generate dan manipulasi QR code di frontend
- **Blade Template** - Templating engine Laravel
- **Eloquent ORM** - Database query

---

Sekarang sistem absensi QR Anda sudah lengkap dengan manajemen rapat yang terintegrasi!
