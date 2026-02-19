# Fitur Export Data Absensi ke Excel dengan Gambar Tanda Tangan

## 📋 Ringkasan

Fitur ekspor telah ditingkatkan untuk menampilkan **tanda tangan sebagai gambar PNG/JPG** bukan sebagai text base64, sehingga file Excel lebih profesional dan mudah dicetak.

## ✨ Fitur-Fitur Baru

### 1. Preview Tanda Tangan di Web
- Kolom "Tanda Tangan" ditambahkan di tabel daftar peserta
- Tombol "👁️ Lihat" untuk preview tanda tangan
- Modal popup untuk melihat tanda tangan dengan ukuran lebih besar
- Tombol download untuk mengunduh tanda tangan individual

### 2. Export ke Excel dengan Gambar
- Tombol "📥 Export ke Excel" di halaman detail rapat
- Tombol "Export" di admin panel Filament
- Excel file berisi:
  - No, Nama, Jabatan, Waktu Scan, Status
  - **Kolom Tanda Tangan dengan gambar PNG/JPG**
  - Gambar otomatis di-embed ke dalam file Excel

### 3. Naming Convention
File yang di-export: `Absensi_[Judul Rapat]_[Tanggal Jam].xlsx`

Contoh: `Absensi_Meeting_Bulanan_18-02-2026_14-30-45.xlsx`

## 🔧 Teknologi & Library

### Requirements
- PHP 8.2+
- Laravel 12
- Filament 5.2+

### Library Tambahan (Perlu diinstall)
```bash
composer require maatwebsite/excel
```

### Dependencies
- `Maatwebsite\Excel` - Untuk export Excel
- `PhpOffice\PhpSpreadsheet` - Untuk manipulasi spreadsheet
- `PhpOffice\PhpSpreadsheet\Worksheet\Drawing` - Untuk embed gambar

## 📁 File-File yang Dibuat/Diupdate

### Baru Dibuat:
1. **`app/Filament/Exports/AbsensiExport.php`** - Class export data
2. **`app/Http/Controllers/ExportController.php`** - Controller untuk export
3. **`EXPORT_EXCEL_SETUP.md`** - Dokumentasi instalasi

### Diupdate:
1. **`app/Filament/Resources/Rapats/Tables/RapatsTable.php`** - Tambah action export
2. **`resources/views/rapat/show.blade.php`** - Tambah kolom tanda tangan & modal preview
3. **`routes/web.php`** - Tambah route export

## 🚀 Cara Menggunakan

### Dari Halaman Web (Public)

#### 1. Akses Detail Rapat
- Buka halaman daftar rapat
- Klik rapat yang ingin dilihat
- Scroll ke bagian "Daftar Peserta Absensi"

#### 2. Preview Tanda Tangan
- Klik tombol "👁️ Lihat" di kolom Tanda Tangan
- Modal popup akan muncul menampilkan tanda tangan
- Klik "Download" untuk mengunduh tanda tangan individual
- Klik "Tutup" atau klik di luar modal untuk menutup

#### 3. Export ke Excel
- Klik tombol "📥 Export ke Excel" (muncul jika ada peserta absen)
- File Excel akan otomatis diunduh ke komputer
- Buka file dengan aplikasi spreadsheet (Excel, LibreOffice, Google Sheets, dll)

### Dari Admin Panel Filament

#### 1. Login ke Admin Panel
- Akses dashboard admin
- Navigasi ke menu "Kelola Rapat"

#### 2. Export dari Tabel
- Lihat daftar rapat dalam bentuk tabel
- Rapat yang memiliki peserta absen menampilkan tombol "Export"
- Klik tombol untuk mengunduh Excel

## 📊 Struktur File Excel

### Header
| No. | Nama | Jabatan | Waktu Scan | Status | Tanda Tangan |
|-----|------|---------|-----------|--------|-------------|

### Data Rows
- **No**: Nomor urut (1, 2, 3, dst)
- **Nama**: Nama peserta absen
- **Jabatan**: Jabatan peserta
- **Waktu Scan**: Format `dd/mm/yyyy hh:mm:ss`
- **Status**: "Hadir" atau "Telat"
- **Tanda Tangan**: **Gambar PNG** (50px tinggi x 80px lebar)

### Contoh Output
```
┌────┬────────┬─────────┬──────────────────┬────────┬─────────────────┐
│ 1  │ Adi    │ Manager │ 18/02/2026 09:30 │ Hadir  │ [GAMBAR PNG]    │
├────┼────────┼─────────┼──────────────────┼────────┼─────────────────┤
│ 2  │ Budi   │ Staff   │ 18/02/2026 09:35 │ Telat  │ [GAMBAR PNG]    │
├────┼────────┼─────────┼──────────────────┼────────┼─────────────────┤
│ 3  │ Citra  │ Asisten │ 18/02/2026 09:28 │ Hadir  │ [GAMBAR PNG]    │
└────┴────────┴─────────┴──────────────────┴────────┴─────────────────┘
```

## 🎯 Keuntungan Menggunakan Fitur Ini

✅ **Gambar bukan Text** - Tanda tangan ditampilkan sebagai PNG/JPG bukan base64
✅ **File Ringan** - Excel file lebih kecil dan cepat untuk diproses
✅ **Profesional** - Tampilan lebih rapi dan mudah dicetak
✅ **Mudah Diverifikasi** - Tanda tangan terlihat jelas dan dapat diaudit
✅ **Kompatibel** - Dapat dibuka di Excel, LibreOffice, Google Sheets, dll
✅ **Mobile Friendly** - Dapat diakses dan diunduh dari smartphone
✅ **Otomatis** - Gambar otomatis di-embed dalam file Excel

## ⚙️ Proses Teknis

### 1. Penyimpanan Tanda Tangan
```
Input: Canvas base64 (data:image/png;base64,...)
↓
Decode base64
↓
Simpan ke file PNG: public/uploads/[uuid].png
↓
Simpan path ke database: uploads/[uuid].png
```

### 2. Export Process
```
Pilih tombol Export
↓
Ambil data absensi dari database
↓
Cek file tanda tangan di public/uploads/
↓
Generate Excel dengan menyisipkan gambar
↓
Download file Excel
```

### 3. Visualisasi di Excel
```
Kolom F: Tanda Tangan (ImageColumn)
↓
Ukuran: 50px x 80px
↓
Format: PNG/JPG
↓
Baris: Sesuai dengan row data peserta
```

## 🔍 Troubleshooting

### Gambar tidak muncul di Excel
**Solusi:**
1. Pastikan file di `public/uploads/` ada dan readable
2. Check permission folder (minimal 755)
3. Verify path di database (harus `uploads/[filename].png`)
4. Jalankan `php artisan storage:link` jika menggunakan symbolic link

### Export button tidak muncul
**Solusi:**
1. Pastikan rapat memiliki peserta absen minimal 1
2. Refresh halaman
3. Clear browser cache

### Error saat download Excel
**Solusi:**
1. Cek permission folder `storage/` (writable)
2. Cek disk space
3. Jalankan `composer dump-autoload`
4. Restart webserver

### Gambar terlalu besar/kecil di Excel
**Solusi:**
Edit di `app/Filament/Exports/AbsensiExport.php`:
```php
$drawing->setHeight(50);  // Ubah tinggi
$drawing->setWidth(80);   // Ubah lebar
```

## 📝 Testing Checklist

- [ ] Buat rapat baru
- [ ] Generate QR code
- [ ] Scan QR code dan isi absensi (minimal 2 peserta)
- [ ] Buka halaman detail rapat
- [ ] Klik "👁️ Lihat" untuk preview tanda tangan
- [ ] Download tanda tangan individual
- [ ] Klik "📥 Export ke Excel"
- [ ] Unduh dan buka file Excel
- [ ] Cek apakah gambar tanda tangan muncul di kolom F
- [ ] Cek data lainnya (nama, jabatan, waktu, status)
- [ ] Coba print file Excel

## 🎓 Workflow Lengkap

```
1. Admin Buat Rapat
   ↓
2. Kirim QR Code ke Peserta
   ↓
3. Peserta Scan QR & Absen
   ↓ (Input Tanda Tangan via Canvas)
   ↓
4. Tanda Tangan Disimpan Jadi PNG di public/uploads/
   ↓
5. Admin Buka Detail Rapat
   ↓
6. Lihat Daftar Peserta + Preview Tanda Tangan
   ↓
7. Klik Export ke Excel
   ↓
8. Download File Excel dengan Gambar Tanda Tangan
   ↓
9. Cetak atau Arsipkan
```

## 📦 Installation Steps

1. **Install Package**
   ```bash
   composer require maatwebsite/excel
   ```

2. **Publish Config (Optional)**
   ```bash
   php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
   ```

3. **Clear Cache**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

4. **Restart Server**
   ```bash
   php artisan serve
   ```

5. **Test Export**
   - Buat rapat dengan peserta absen
   - Klik tombol Export
   - Cek file Excel yang di-download

---

**Status**: ✅ Siap digunakan setelah menjalankan `composer require maatwebsite/excel`
