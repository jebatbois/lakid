# LAKID - Sistem Informasi HKI Dinas

Dokumentasi Lengkap Implementasi Aplikasi Web Layanan Kekayaan Intelektual Digital

---

## 📋 Daftar Isi
1. [Ringkasan Proyek](#ringkasan-proyek)
2. [Arsitektur Sistem](#arsitektur-sistem)
3. [Fitur Utama](#fitur-utama)
4. [Panduan Pengguna](#panduan-pengguna)
5. [Informasi Teknis](#informasi-teknis)
6. [Status Implementasi](#status-implementasi)

---

## Ringkasan Proyek

**LAKID** adalah aplikasi web pemerintah untuk mengelola permohonan Hak Kekayaan Intelektual (HKI) secara digital. Aplikasi ini dibangun menggunakan:

- **Framework**: Laravel 11 dengan Breeze Authentication Stack
- **Frontend**: Blade Template Engine + Tailwind CSS + Alpine.js
- **Database**: MySQL
- **Server**: PHP 8.3+

### Tujuan Aplikasi
- Memudahkan masyarakat dalam pengajuan HKI secara online
- Menyediakan dashboard admin untuk review dan approval pengajuan
- Mengelola dokumen dan status pengajuan secara terpusat

---

## Arsitektur Sistem

### Struktur Folder

```
lakid/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PengajuanController.php (User CRUD)
│   │   │   └── AdminController.php (Admin Management)
│   │   ├── Middleware/
│   │   │   └── IsAdmin.php (Admin Authorization)
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   └── Pengajuan.php
│   └── Providers/
│       └── AppServiceProvider.php
├── routes/
│   ├── web.php (Aplikasi Routes)
│   └── auth.php (Authentication Routes)
├── resources/
│   ├── views/
│   │   ├── pengajuan/
│   │   │   ├── create.blade.php
│   │   │   ├── index.blade.php
│   │   │   ├── show.blade.php
│   │   │   └── edit.blade.php
│   │   ├── admin/
│   │   │   └── dashboard.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── welcome.blade.php
│   │   └── ... (auth views dari Breeze)
│   ├── css/app.css
│   ├── js/app.js
│   └── js/bootstrap.js
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   └── 2026_01_15_023330_create_pengajuans_table.php
│   ├── factories/
│   │   └── UserFactory.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── public/
│   ├── storage/ → ../storage/app/public (symlink)
│   ├── uploads/ (File upload storage)
│   └── ... (static assets)
├── storage/
│   ├── app/public/ (File storage)
│   ├── framework/ (Cache/Sessions)
│   └── logs/
├── tests/ (Unit & Feature tests)
├── artisan (CLI tool)
├── composer.json
├── package.json
└── ... (config files)
```

### Database Schema

#### Tabel: users
| Kolom | Tipe | Deskripsi |
|-------|------|----------|
| id | int | Primary Key |
| name | string | Nama Pengguna |
| email | string | Email Unik |
| email_verified_at | timestamp | Email Verification |
| password | string | Password Terenkripsi |
| created_at | timestamp | Waktu Dibuat |
| updated_at | timestamp | Waktu Diupdate |

#### Tabel: pengajuans
| Kolom | Tipe | Deskripsi |
|-------|------|----------|
| id | int | Primary Key |
| user_id | int | Foreign Key ke users |
| nama_merek | string | Nama Merek/Produk |
| jenis | string | Jenis HKI (Merek, Paten, dll) |
| deskripsi_karya | text | Deskripsi Detail |
| status | string | Draft, Diajukan, Ditinjau, Disetujui, Ditolak |
| file_logo | string | Path File Logo/Desain |
| file_ktp | string | Path File KTP |
| catatan_admin | text | Catatan dari Admin |
| created_at | timestamp | Waktu Dibuat |
| updated_at | timestamp | Waktu Diupdate |

---

## Fitur Utama

### 1. **Sistem Autentikasi & Otorisasi**
- ✅ Registrasi & Login
- ✅ Email Verification
- ✅ Password Reset
- ✅ Smart Redirect (Admin → Admin Dashboard, User → User Dashboard)
- ✅ IsAdmin Middleware (berbasis email)

### 2. **Dashboard User**
- ✅ Melihat daftar pengajuan mereka sendiri
- ✅ Filter berdasarkan status
- ✅ Aksi cepat (create, view, edit, delete, submit)

### 3. **Manajemen Pengajuan User**
- ✅ **Create**: Form dengan validasi file (PNG/JPG, max 2MB)
  - Input: Nama Merek, Jenis HKI, Deskripsi, File Logo, File KTP
  - Upload ke: `/public/uploads/`
  - Status awal: Draft

- ✅ **Read**: Lihat detail pengajuan
  - Informasi lengkap pengajuan
  - Preview image dari file
  - Download link untuk dokumen

- ✅ **Update**: Edit pengajuan (hanya status Draft)
  - Update semua field
  - Ganti file
  - Old files otomatis dihapus

- ✅ **Delete**: Hapus pengajuan (hanya status Draft)
  - Soft/Hard delete
  - File storage dibersihkan

- ✅ **Submit**: Ubah status Draft → Diajukan
  - Pengajuan siap untuk review admin
  - User tidak bisa edit setelah submit

### 4. **Dashboard Admin**
- ✅ Daftar semua pengajuan dari semua user
- ✅ Tabel responsif dengan info lengkap
  - Tanggal, Pemohon, Nama Merek, Jenis HKI, Status
  - Aksi: Edit Status, Lihat Detail

### 5. **Manajemen Status Admin**
- ✅ Update status pengajuan
  - Pilihan: Ditinjau, Disetujui, Ditolak
  - Tambah catatan untuk user

- ✅ Modal untuk UX yang lebih baik

---

## Panduan Pengguna

### Untuk User Biasa

#### 1. Registrasi
```
1. Klik "Register" di halaman login
2. Isi form dengan:
   - Nama lengkap
   - Email
   - Password (min 8 karakter)
3. Klik "Register"
4. Verifikasi email
```

#### 2. Membuat Pengajuan Baru
```
1. Login dengan akun user
2. Klik "Pengajuan" di navbar → "Buat Pengajuan Baru"
3. Isi form:
   - Nama Merek: [nama produk/merek anda]
   - Jenis HKI: Pilih salah satu (Merek, Hak Cipta, dll)
   - Deskripsi: Jelaskan karya anda
   - File Logo: Upload gambar (PNG/JPG, max 2MB)
   - File KTP: Upload scan KTP (PNG/JPG, max 2MB)
4. Klik "Simpan Pengajuan"
5. Status akan menjadi "Draft" - bisa diedit atau dihapus
```

#### 3. Edit Pengajuan Draft
```
1. Buka pengajuan yang statusnya masih "Draft"
2. Klik "Edit"
3. Ubah data/file sesuai kebutuhan
4. Klik "Simpan Perubahan"
```

#### 4. Mengajukan Pengajuan
```
1. Buka pengajuan status "Draft"
2. Klik "Ajukan Sekarang"
3. Status berubah menjadi "Diajukan"
4. Admin akan meninjau pengajuan anda
```

#### 5. Melihat Catatan Admin
```
1. Buka detail pengajuan
2. Scroll ke bawah untuk melihat "Catatan Admin"
3. Admin akan memberikan feedback atau alasan approve/reject
```

### Untuk Admin

#### 1. Login Admin
```
Email: admin@lakid.kepri.prov.go.id
Password: [sesuai yang diberikan]

Note: Login sebagai user biasa akan auto-redirect ke admin dashboard
```

#### 2. Review Pengajuan
```
1. Masuk Dashboard Admin
2. Lihat tabel daftar pengajuan
3. Klik "Edit Status" pada pengajuan yang ingin direview
```

#### 3. Ubah Status & Beri Catatan
```
Modal akan muncul dengan:
- Dropdown Status: Pilih salah satu
  * Ditinjau: Sedang diproses
  * Disetujui: Pengajuan diterima
  * Ditolak: Pengajuan ditolak
- Catatan Admin: Isi keterangan (opsional)
4. Klik "Simpan Perubahan"
```

#### 4. Lihat Detail Pengajuan
```
1. Dari tabel, klik "Lihat" pada pengajuan
2. Lihat semua informasi lengkap
3. Download dokumen dari link yang tersedia
```

---

## Informasi Teknis

### Routes Map

#### User Routes (Requires auth middleware)
```php
GET|HEAD   /pengajuan              - List pengajuans (PengajuanController@index)
POST       /pengajuan              - Create pengajuan (PengajuanController@store)
GET|HEAD   /pengajuan/create       - Show create form (PengajuanController@create)
GET|HEAD   /pengajuan/{id}         - Show detail (PengajuanController@show)
GET|HEAD   /pengajuan/{id}/edit    - Show edit form (PengajuanController@edit)
PUT|PATCH  /pengajuan/{id}         - Update pengajuan (PengajuanController@update)
DELETE     /pengajuan/{id}         - Delete pengajuan (PengajuanController@destroy)
POST       /pengajuan/{id}/submit  - Submit untuk review (PengajuanController@submit)
```

#### Admin Routes (Requires auth + isAdmin middleware)
```php
GET|HEAD  /admin/dashboard                - Admin dashboard (AdminController@index)
PATCH     /admin/pengajuan/{id}/status    - Update status (AdminController@updateStatus)
```

#### Public Routes
```php
GET /              - Welcome page
GET /login         - Login form
POST /login        - Process login
GET /register      - Register form
POST /register     - Process registration
GET /dashboard     - Smart redirect to admin/user dashboard
```

### File Upload

**Lokasi**: `/public/uploads/`
**Tipe File**: PNG, JPG
**Ukuran Max**: 2MB per file
**Validasi**:
- Client-side: JavaScript validation saat upload
- Server-side: Laravel validation rules

**Struktur Path**:
```
uploads/
├── [user_id]/
│   ├── logo_[timestamp]_[name]
│   └── ktp_[timestamp]_[name]
```

### Middleware

#### IsAdmin Middleware
```php
Location: app/Http/Middleware/IsAdmin.php

Logic:
- Check if user email === 'admin@lakid.kepri.prov.go.id'
- If yes: allow request
- If no: redirect to /dashboard with error

Registered: bootstrap/app.php sebagai 'isAdmin'
```

#### Laravel Built-in
- `auth`: Check user is authenticated
- `verified`: Check email is verified

### Model Relationships

```
User
├── pengajuans() → HasMany (Pengajuan)

Pengajuan
├── user() → BelongsTo (User)
```

### Validation Rules

**PengajuanController::store/update**
```php
'nama_merek' => 'required|string|max:255'
'jenis' => 'required|string|in:Merek,Paten,Desain Industri,Hak Cipta'
'deskripsi_karya' => 'required|string|max:2000'
'file_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
'file_ktp' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
```

**AdminController::updateStatus**
```php
'status' => 'required|in:Ditinjau,Disetujui,Ditolak'
'catatan_admin' => 'nullable|string|max:1000'
```

---

## Status Implementasi

### ✅ Selesai

| Fitur | Status | Catatan |
|-------|--------|---------|
| User Registration & Login | ✅ | Dengan email verification |
| Smart Dashboard Redirect | ✅ | Admin & User auto-redirect |
| Pengajuan CRUD | ✅ | Full create, read, update, delete |
| File Upload | ✅ | 2MB limit, PNG/JPG only |
| Pengajuan Submit | ✅ | Draft → Diajukan |
| Admin Dashboard | ✅ | Lihat semua pengajuan |
| Status Update | ✅ | With admin notes |
| IsAdmin Middleware | ✅ | Email-based authorization |
| Responsive Design | ✅ | Tailwind CSS + Dark mode |
| Database Migration | ✅ | Semua table siap |
| Routes Configuration | ✅ | All routes registered |
| Error Handling | ✅ | Validation & 403 checks |
| File Storage Management | ✅ | Auto cleanup on delete |

### 📝 Pengajuan States (Status Workflow)

```
┌─────────────────────────────────────────────────────────┐
│ User membuat pengajuan                                  │
└─────────────────────────────────────────────────────────┘
              ↓
        [Draft] ← User dapat edit/delete/submit
              ↓
    User klik "Ajukan Sekarang"
              ↓
     [Diajukan] ← Admin sedang tinjau
              ↓
    Admin klik "Edit Status"
          ↙     ↘
      ↙           ↘
[Ditinjau]    [Ditolak]
     ↓              ↓
  Admin bisa  User notif &
   approve   bisa lihat alasan
     ↓
[Disetujui]
     ↓
Pengajuan diterima
```

### 🔐 Access Control

| Route | Public | User Auth | Admin |
|-------|--------|-----------|-------|
| `/` | ✅ | ✅ | ✅ |
| `/login` | ✅ | ❌ | ❌ |
| `/register` | ✅ | ❌ | ❌ |
| `/dashboard` | ❌ | ✅ | ✅ (redirect) |
| `/pengajuan/*` | ❌ | ✅ | ❌ |
| `/admin/dashboard` | ❌ | ❌ | ✅ |
| `/admin/pengajuan/*/status` | ❌ | ❌ | ✅ |

---

## Testing

### Akun Test yang Tersedia

```
1. Admin Account:
   Email: admin@lakid.kepri.prov.go.id
   Password: [default dari seeding atau setup]

2. User Account:
   Email: user@test.com
   Password: password123
```

### Test Scenarios

#### Test 1: User Flow
```
1. Login sebagai user@test.com
2. Auto-redirect ke /dashboard (user dashboard)
3. Klik "Buat Pengajuan Baru"
4. Isi form & upload files
5. Klik submit → status menjadi Diajukan
6. Kembali ke list, lihat pengajuan appear
```

#### Test 2: Admin Flow
```
1. Login sebagai admin@lakid.kepri.prov.go.id
2. Auto-redirect ke /admin/dashboard
3. Lihat semua pengajuan dari semua user
4. Klik "Edit Status" pada salah satu
5. Ubah status & tambah catatan
6. Klik "Simpan Perubahan"
7. Kembali, status sudah terupdate
```

#### Test 3: File Validation
```
1. Upload file > 2MB → error message
2. Upload file non-image → error
3. Upload valid file → success
```

---

## Troubleshooting

### Storage Link Issue
```bash
php artisan storage:link
```

### Cache Clear
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Database Reset
```bash
php artisan migrate:fresh --seed
```

### View Cache
```bash
php artisan view:clear
```

---

## Development Server

```bash
# Start development server
php artisan serve --host=0.0.0.0 --port=8000

# Access di browser
http://localhost:8000
```

---

## Production Deployment

1. **Environment Configuration**
   - Copy `.env.example` ke `.env`
   - Set APP_KEY: `php artisan key:generate`
   - Configure database credentials
   - Set APP_ENV=production

2. **Dependencies**
   ```bash
   composer install --no-dev
   npm install && npm run build
   ```

3. **Database**
   ```bash
   php artisan migrate --force
   ```

4. **Permissions**
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

5. **Caching**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## Kontak & Support

Untuk pertanyaan atau bantuan, hubungi:
- **Email**: admin@lakid.kepri.prov.go.id
- **Telepon**: [nomor kontak dinas]
- **Website**: [website dinas]

---

**Dokumen ini terakhir diupdate**: 15 Januari 2026
**Versi Aplikasi**: 1.0.0
**Status**: ✅ Ready for Production
