# Pasar Modern - Sistem Informasi Pasar

Sistem informasi pasar modern yang menyediakan informasi lengkap tentang pasar, harga komoditas, berita, dan galeri.

## Fitur Utama

- **Dashboard Admin** - Panel admin yang lengkap dengan statistik real-time
- **Manajemen Berita** - CRUD berita dengan kategori dan status publikasi
- **Manajemen Galeri** - Upload dan kelola foto galeri
- **Manajemen Video** - Upload dan kelola video
- **Manajemen Harga** - Data harga komoditas harian
- **Manajemen Pasar** - Informasi lengkap tentang pasar
- **Manajemen User** - Sistem user admin dengan role-based access
- **Feedback System** - Sistem feedback dari pengguna

## Sistem Status User Otomatis

Sistem ini menggunakan **status user otomatis** berdasarkan aktivitas login/logout, bukan pilihan manual:

### Cara Kerja Status Otomatis

1. **Login**: Status otomatis menjadi "online" saat user login
2. **Aktivitas**: Status tetap "online" selama ada aktivitas dalam 30 menit terakhir
3. **Logout**: Status otomatis menjadi "offline" saat user logout
4. **Timeout**: Status otomatis menjadi "offline" jika tidak ada aktivitas selama 30 menit

### Field Database yang Digunakan

- `last_login` - Waktu terakhir user login
- `last_activity` - Waktu terakhir user melakukan aktivitas
- **TIDAK ADA** field `status` manual

### Method Model yang Tersedia

```php
// Update last login dan activity saat login
$adminModel->updateLastLogin($adminId);

// Update last activity saat ada aktivitas
$adminModel->updateLastActivity($adminId);

// Get status otomatis berdasarkan last_activity
$status = $adminModel->getAdminStatus($adminId);

// Get semua admin dengan status otomatis
$admins = $adminModel->getAdminsWithStatus();
```

## Struktur Form Modern

Sistem ini menggunakan style form modern yang rapi dan sederhana dengan fitur:

### CSS Classes Utama

#### Form Container
```css
.modern-form-container     /* Container utama form */
.modern-form-header       /* Header form dengan gradient */
.modern-form-body         /* Body form dengan padding */
```

#### Form Groups
```css
.modern-form-group        /* Group input dengan spacing */
.modern-form-group label  /* Label dengan style modern */
.modern-form-group .form-control  /* Input dengan border dan focus effect */
```

#### Form Sections
```css
.modern-form-section      /* Section dengan background dan border */
.modern-form-section-header  /* Header section */
.modern-form-section-title   /* Judul section */
```

#### Form Grid
```css
.modern-form-grid.cols-2  /* Grid 2 kolom responsive */
.modern-form-grid.cols-3  /* Grid 3 kolom responsive */
```

#### Form Actions
```css
.modern-form-actions      /* Container tombol aksi */
.modern-form-actions .btn /* Style tombol dengan hover effect */
```

### Fitur Form

1. **Responsive Design** - Otomatis menyesuaikan dengan ukuran layar
2. **Modern Styling** - Border radius, shadow, dan gradient yang modern
3. **Focus Effects** - Border biru dan shadow saat focus
4. **Help Text** - Teks bantuan dengan icon yang informatif
5. **Validation States** - Border merah untuk input yang error
6. **File Upload** - Area upload file yang menarik dengan drag & drop
7. **Section Organization** - Form dibagi menjadi section yang logis

### Contoh Penggunaan

```html
<div class="modern-form-container">
    <div class="modern-form-header">
        <h3 class="modern-form-title">
            <i class="bi bi-person-plus"></i>
            Form Tambah User
        </h3>
        <p class="modern-form-subtitle">Lengkapi data user dengan informasi yang akurat</p>
    </div>
    
    <div class="modern-form-body">
        <form method="POST">
            <div class="modern-form-grid cols-2">
                <div class="modern-form-group">
                    <label for="username" class="required">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                    <div class="modern-form-help">
                        <i class="bi bi-lightbulb"></i>
                        Username unik untuk login
                    </div>
                </div>
                
                <div class="modern-form-group">
                    <label for="email" class="required">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="modern-form-help">
                        <i class="bi bi-envelope"></i>
                        Email aktif untuk notifikasi
                    </div>
                </div>
            </div>
            
            <div class="modern-form-actions">
                <a href="/admin/user" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
```

## Instalasi

1. Clone repository ini
2. Install dependencies dengan `composer install`
3. Copy `.env.example` ke `.env` dan sesuaikan konfigurasi database
4. Jalankan migration dengan `php spark migrate`
5. Jalankan seeder dengan `php spark db:seed`
6. Akses aplikasi di browser

## Teknologi

- **Backend**: CodeIgniter 4
- **Frontend**: Bootstrap 5, Bootstrap Icons
- **Database**: MySQL/MariaDB
- **CSS**: Custom modern form styles
- **JavaScript**: Vanilla JS dengan Chart.js untuk grafik

## Lisensi

MIT License - lihat file LICENSE untuk detail lebih lanjut.
