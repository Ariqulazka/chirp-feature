<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instruksi Pemakaian Laravel

Ikuti langkah-langkah berikut untuk memulai proyek Laravel Anda:

1. **Clone Repositori**
   Clone repositori Laravel ke lokal Anda dengan menggunakan Git:

   ```bash
   git clone <repository_url>
   ```

2. **Update Composer**
   Pastikan semua dependensi PHP terinstal dengan menjalankan perintah berikut:

   ```bash
   composer install
   ```

3. **Install NPM**
   Instal semua dependensi frontend dengan NPM:

   ```bash
   npm install
   ```

4. **Buka Proyek di Visual Studio Code**
   Setelah menginstal dependensi, buka folder proyek dengan Visual Studio Code:

   ```bash
   code .
   ```

5. **Salin File .env**
   Salin file `.env.example` menjadi `.env`:

   ```bash
   cp .env.example .env
   ```

6. **Generate Kunci Aplikasi**
   Jalankan perintah berikut untuk menghasilkan kunci aplikasi yang dibutuhkan oleh Laravel:

   ```bash
   php artisan key:generate
   ```

7. **Migrasi Database dan Seeding**
   Jalankan perintah untuk migrasi dan seeding database:

   ```bash
   php artisan migrate --seed
   ```

8. **Jalankan Aplikasi Laravel**
   Jalankan server aplikasi dengan perintah berikut:

   ```bash
   php artisan serve
   ```

9. **Jalankan NPM untuk Development**
   Jalankan NPM untuk kompilasi aset dan menjalankan pengembangan frontend:

   ```bash
   npm run dev
   ```

Sekarang Anda dapat membuka aplikasi di browser dengan mengakses `http://localhost:8000`.
