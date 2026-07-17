Projek LSP -- Case 16 (Donor Darah) 
Zavier Billy Prasetyo 
2226560102

Panduan Instalasi Projek Donor Darah

Projek ini merupakan aplikasi web manajemen donor darah yang dibangun menggunakan teknologi modern. Panduan di bawah ini akan membantu Anda mengatur dan menjalankan projek di lingkungan pengembangan lokal (local environment).

🛠️ Spesifikasi & Requirements

Sebelum memulai instalasi, pastikan sistem komputer Anda telah memenuhi persyaratan berikut:

- PHP (Minimal versi 8.3 - Syarat Laravel 13)
- Framework: Laravel 13
- CSS Framework: Tailwind CSS v4.3.2
- Database: MySQL

Tools pendukung:

- XAMPP / Laragon (Untuk local server MySQL)
- Composer (Untuk manajemen dependensi PHP)
- Node.js & NPM (Untuk kompilasi aset Frontend/Tailwind)
- Git (Untuk cloning repositori)

🚀 Langkah-langkah Instalasi

Ikuti 9 langkah detail di bawah ini secara berurutan untuk menjalankan projek:

1. Clone Repository

    Buka terminal/Command Prompt Anda, lalu jalankan perintah berikut untuk mengunduh kode sumber dari GitHub:
    
    git clone https://github.com/Zaphierre/LSP_Project_DonorDarah


2. Masuk ke Direktori Projek

    Arahkan terminal ke dalam folder projek yang baru saja di-clone:
    
    cd "LSP Zavier/LSP_Project_DonorDarah"


3. Install Dependensi PHP (Composer)

    Unduh seluruh library dan dependensi Laravel yang dibutuhkan aplikasi dengan menjalankan:
    
    composer install


4. Konfigurasi Environment & Database

    Salin file pengaturan bawaan dan sesuaikan dengan konfigurasi database lokal Anda.
    Pertama, jalankan perintah ini:
    
    cp .env.example .env


    Setelah itu, buka file .env di text editor Anda, cari bagian konfigurasi database, dan ubah nilainya menjadi seperti contoh berikut:
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_donor
    DB_USERNAME=root
    DB_PASSWORD=


(Catatan: Pastikan Anda telah membuat database kosong dengan nama db_donor di MySQL/phpMyAdmin Anda).

5. Generate Application Key

    Buat kunci unik keamanan enkripsi aplikasi Laravel dengan menjalankan perintah:
    
    php artisan key:generate


6. Hubungkan Direktori Storage (Storage Link)

    Buat shortcut (symlink) dari folder storage ke folder public agar file seperti gambar/dokumen yang diunggah dapat diakses:
    
    php artisan storage:link


7. Migrasi Tabel & Seeder

    Buat seluruh tabel di database dan isi dengan data awal (dummy data) menggunakan perintah berikut:
    
    php artisan migrate:fresh --seed


8. Jalankan Server Backend (Laravel)

    Nyalakan server lokal bawaan Laravel untuk menjalankan fungsionalitas backend:
    
    php artisan serve


(Server biasanya akan berjalan di http://127.0.0.1:8000)

9. Jalankan Server Frontend (Tailwind/Vite)

    Buka tab terminal baru (biarkan terminal langkah 8 tetap berjalan), pastikan Anda berada di direktori projek yang sama, lalu install dan jalankan proses build aset:
    
    npm install
    npm run dev


🎉 Selesai! Aplikasi sudah siap dan bisa Anda akses melalui browser di alamat http://127.0.0.1:8000.
