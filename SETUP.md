# Setup Database dan Autentikasi

## Langkah-langkah Setup

### 1. Update Database Connection

Edit file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=healthy_store
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Jalankan Migrations

```bash
php artisan migrate
```

Atau jika ada migration baru:

```bash
php artisan migrate:refresh
```

### 3. Buat Admin User (Optional)

Buat file baru atau gunakan tinker:

```bash
php artisan tinker
```

Kemudian jalankan:

```php
$user = App\Models\User::create([
    'first_name' => 'Admin',
    'last_name' => 'Store',
    'email' => 'admin@healthystore.com',
    'phone' => '082123456789',
    'password' => Hash\Hash::make('password'),
    'role' => 'admin',
]);
```

### 4. Jalankan Server

```bash
php artisan serve
```

## User Roles

-   **user**: User biasa (customer)
-   **admin**: Administrator toko

## Routes

### Public Routes

-   `GET /` - Halaman home
-   `GET /register` - Halaman registrasi
-   `POST /register` - Submit registrasi
-   `GET /login` - Halaman login
-   `POST /login` - Submit login

### Protected Routes (Auth)

-   `POST /logout` - Logout
-   `GET /user/dashboard` - Dashboard user

### Admin Routes (Auth + Admin Middleware)

-   `GET /admin/dashboard` - Dashboard admin

## Fitur Autentikasi

✅ Registrasi dengan validasi form
✅ Login dengan email & password
✅ Remember me functionality
✅ Role-based access control
✅ Admin middleware protection
✅ Logout dengan session invalidation

## SSO Google (TODO)

Google OAuth belum diintegrasikan. Anda bisa menambahkannya sendiri menggunakan:

-   Laravel Socialite
-   Google OAuth 2.0

## File Struktur yang Dibuat

```
app/Http/Controllers/Auth/
├── AuthenticatedSessionController.php
└── RegisteredUserController.php

app/Http/Middleware/
└── IsAdmin.php

resources/views/
├── layouts/
│   ├── app.blade.php
│   └── auth.blade.php
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── user/
│   └── dashboard.blade.php
└── admin/
    └── dashboard.blade.php

database/migrations/
└── 2026_02_01_000003_add_fields_to_users_table.php
```

## Catatan

-   Password minimal 8 karakter dengan kombinasi huruf, angka, dan simbol
-   Email harus unik di database
-   Role user default adalah 'user'
-   Admin bisa akses dashboard admin jika role-nya 'admin'
