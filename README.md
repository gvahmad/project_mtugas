# Project MTugas - Sistem Manajemen Tugas

Aplikasi web untuk manajemen tugas berbasis Laravel. Sistem ini dirancang untuk memudahkan pengguna dalam membuat, mengelola, dan melacak progress tugas-tugas mereka.

## 📋 Daftar Isi

- [Tentang Aplikasi](#tentang-aplikasi)
- [Fitur Utama](#fitur-utama)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Cara Menjalankan](#cara-menjalankan)
- [Role & Tanggung Jawab Admin](#role--tanggung-jawab-admin)
- [Struktur Database](#struktur-database)
- [Penggunaan Aplikasi](#penggunaan-aplikasi)

## 🎯 Tentang Aplikasi

**Project MTugas** adalah aplikasi manajemen tugas yang memungkinkan:
- Pengguna untuk membuat dan mengelola tugas pribadi atau tim
- Admin untuk mengelola user, tugas, dan laporan sistem
- Tracking progress tugas secara real-time
- Kolaborasi antar user dalam menyelesaikan tugas

## ✨ Fitur Utama

- ✅ Autentikasi User (Login/Register)
- ✅ CRUD Tugas (Create, Read, Update, Delete)
- ✅ Pengelolaan Status Tugas (Pending, In Progress, Completed)
- ✅ Dashboard Analytics
- ✅ Sistem Role & Permission (Admin, User)
- ✅ Laporan & Export Data
- ✅ Real-time Notifications

## 💻 Persyaratan Sistem

### Software Requirements
- **PHP** >= 8.1
- **Composer** (PHP Package Manager)
- **Node.js** >= 16.x & npm (untuk front-end assets)
- **MySQL/MariaDB** >= 5.7
- **Git**
- **Visual Studio Code** (opsional, untuk development)

### Persyaratan Lainnya
- RAM minimal 2GB
- Storage minimal 500MB
- Koneksi internet (untuk mengunduh dependencies)

## 📥 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/gvahmad/project_mtugas.git
cd project_mtugas
```

Atau jika belum ada repository online, buat folder project:

```bash
mkdir project_mtugas
cd project_mtugas
```

### 2. Install PHP Dependencies

Pastikan Composer sudah terinstall, kemudian jalankan:

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Copy File Environment

```bash
copy .env.example .env
```

Atau di Linux/Mac:

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_mtugas
DB_USERNAME=root
DB_PASSWORD=
```

Buat database baru:

```bash
php artisan migrate:fresh --seed
```

### 7. Build Assets

```bash
npm run build
```

Untuk development dengan live reload:

```bash
npm run dev
```

## ⚙️ Konfigurasi

### File `.env` Penting

```env
APP_NAME=ProjectMTugas
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_mtugas
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@example.com

SESSION_DRIVER=cookie
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

## 🚀 Cara Menjalankan

### Terminal 1 - Laravel Development Server

```bash
php artisan serve
```

Server akan berjalan di: `http://localhost:8000`

### Terminal 2 - Frontend Development (Vite/Webpack)

```bash
npm run dev
```

### Akses Aplikasi

Buka browser dan kunjungi:
- **User Interface**: [http://localhost:8000](http://localhost:8000)
- **Admin Panel**: [http://localhost:8000/admin](http://localhost:8000/admin)

### Akun Default

```
Email: admin@example.com
Password: password

Email: user@example.com
Password: password
```

## 👨‍💼 Role & Tanggung Jawab Admin

### Wewenang Admin

1. **Manajemen User**
   - Melihat daftar semua user
   - Membuat user baru
   - Edit data user
   - Hapus user
   - Reset password user

2. **Manajemen Tugas**
   - Melihat semua tugas dari semua user
   - Membuat tugas untuk user lain
   - Edit tugas
   - Hapus tugas
   - Assign tugas ke user

3. **Laporan & Analytics**
   - Melihat statistik penggunaan aplikasi
   - Export data tugas
   - Laporan progress per user
   - Dashboard overview

4. **Sistem**
   - Manajemen backup database
   - Log aktivitas sistem
   - Setting aplikasi
   - Manajemen role & permission

### Akses Admin Panel

- URL: `http://localhost:8000/admin`
- Hanya user dengan role "Admin" yang dapat mengakses

## 📊 Struktur Database (ERD)

```
┌─────────────────┐
│     users       │
├─────────────────┤
│ id (PK)         │
│ name            │
│ email           │
│ password        │
│ role (enum)     │
│ created_at      │
│ updated_at      │
└────────┬────────┘
         │ 1:n
         │
         ▼
┌─────────────────┐
│     tasks       │
├─────────────────┤
│ id (PK)         │
│ user_id (FK)    │
│ title           │
│ description     │
│ status (enum)   │
│ priority        │
│ due_date        │
│ created_at      │
│ updated_at      │
└─────────────────┘

Status enum: pending, in_progress, completed
Priority enum: low, medium, high
Role enum: admin, user
```

### Tabel Utama

**users**
- id: Integer (Primary Key)
- name: String
- email: String (Unique)
- password: String (Hashed)
- role: Enum (admin, user)
- created_at, updated_at: Timestamp

**tasks**
- id: Integer (Primary Key)
- user_id: Integer (Foreign Key)
- title: String
- description: Text
- status: Enum (pending, in_progress, completed)
- priority: Enum (low, medium, high)
- due_date: Date
- created_at, updated_at: Timestamp

## 📖 Penggunaan Aplikasi

### Sebagai User Biasa

1. **Login** ke aplikasi
2. **Dashboard** - Lihat overview tugas Anda
3. **Buat Tugas Baru** - Klik tombol "New Task"
4. **Edit Tugas** - Klik tugas → Edit
5. **Ubah Status** - Drag tugas atau klik status
6. **Hapus Tugas** - Klik delete pada tugas

### Sebagai Admin

1. **Login** dengan akun admin
2. **Dashboard Admin** - Lihat statistik lengkap
3. **Kelola User** - Menu Users
4. **Kelola Tugas** - Menu Tasks
5. **Lihat Laporan** - Menu Reports
6. **Setting** - Konfigurasi aplikasi

## 🛠️ Troubleshooting

### Error: Class Not Found
```bash
composer dump-autoload
```

### Database Migration Error
```bash
php artisan migrate:fresh
```

### Assets Not Loading
```bash
npm run build
php artisan storage:link
```

### Port 8000 Sudah Terpakai
```bash
php artisan serve --port=8001
```

## 📝 License

Project ini open source dan dilisensikan di bawah MIT License.

## 👥 Support

Untuk bantuan, silakan buat issue di repository atau hubungi developer.

---

**Last Updated**: December 2, 2025
