# Instalasi & Konfigurasi Export Excel dengan Gambar Tanda Tangan

## Status
Fitur Export Excel telah dibuat, namun memerlukan instalasi library tambahan.

## Langkah-Langkah Instalasi

### 1. Install Package maatwebsite/excel
Buka terminal di folder project dan jalankan:

```bash
composer require maatwebsite/excel
```

### 2. Publish Config (Opsional)
```bash
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```

## File-File yang Telah Dibuat

### 1. `app/Filament/Exports/AbsensiExport.php`
- Class untuk export data absensi ke Excel
- Menggunakan `WithDrawings` interface untuk menampilkan gambar tanda tangan
- Fitur:
  - Kolom: No, Nama, Jabatan, Waktu Scan, Status, Tanda Tangan (Image)
  - Gambar tanda tangan ditampilkan dalam ukuran 50px (tinggi) x 80px (lebar)
  - Format otomatis untuk kolom tanggal

### 2. `app/Http/Controllers/ExportController.php`
- Controller untuk menangani export request
- Method `exportAbsensi()` menerima parameter Rapat
- Generate file Excel dengan nama: `Absensi_[Judul Rapat]_[Tanggal].xlsx`

### 3. Routes
- Route: `GET /rapats/{rapat}/export`
- Name: `rapat.export`
- Dapat diakses dari detail rapat

### 4. UI/Views Updates
- Tombol "📥 Export ke Excel" ditambahkan di halaman detail rapat
- Tombol "Export" ditambahkan di admin panel Filament

## Cara Menggunakan

### Dari Halaman Detail Rapat
1. Buka halaman detail rapat
2. Scroll ke bagian "Daftar Peserta Absensi"
3. Klik tombol "📥 Export ke Excel" (hanya muncul jika ada peserta absen)
4. File Excel akan diunduh

### Dari Admin Panel Filament
1. Buka admin panel → Kelola Rapat
2. Lihat tabel rapat
3. Setiap rapat yang memiliki peserta absen akan menampilkan tombol "Export" di kolom aksi
4. Klik tombol untuk mengunduh Excel

## Fitur Excel Output

### Struktur File
```
┌─────┬────────┬──────────┬──────────────┬────────┬───────────────┐
│ No. │ Nama   │ Jabatan  │ Waktu Scan   │ Status │ Tanda Tangan  │
├─────┼────────┼──────────┼──────────────┼────────┼───────────────┤
│ 1   │ Budi   │ Manager  │ 18/02/2026   │ Hadir  │ [GAMBAR PNG]  │
│     │        │          │ 09:30:00     │        │               │
├─────┼────────┼──────────┼──────────────┼────────┼───────────────┤
│ 2   │ Siti   │ Staff    │ 18/02/2026   │ Telat  │ [GAMBAR PNG]  │
│     │        │          │ 09:35:15     │        │               │
└─────┴────────┴──────────┴──────────────┴────────┴───────────────┘
```

### Gambar Tanda Tangan
- **Format**: PNG/JPG dari folder `public/uploads/`
- **Ukuran**: 50px (tinggi) x 80px (lebar)
- **Lokasi**: Kolom F (Tanda Tangan)
- **Posisi**: Setiap baris menampilkan gambar tanda tangan yang sesuai

## Keuntungan

✅ Tanda tangan ditampilkan sebagai **gambar bukan text base64**
✅ File Excel lebih **ringan dan profesional**
✅ Mudah di-print dan di-arsipkan
✅ Kompatibel dengan semua aplikasi spreadsheet
✅ Mudah untuk diaudit dan verifikasi

## Troubleshooting

### Jika gambar tidak muncul
1. Pastikan file tanda tangan ada di folder `public/uploads/`
2. Cek permission folder (minimal 755)
3. Cek path di database (harus `uploads/[filename].png`)

### Jika error saat export
1. Pastikan semua files sudah di-create
2. Jalankan `composer dump-autoload`
3. Pastikan permission folder `storage/` dan `bootstrap/cache/` writable

## Testing

Untuk test fitur export:
1. Buat rapat baru
2. Generate QR code
3. Scan dan isi absensi peserta
4. Buka detail rapat
5. Klik tombol "Export ke Excel"
6. Unduh dan buka file Excel

---

**Status**: Ready to use setelah `composer require maatwebsite/excel` 🚀
