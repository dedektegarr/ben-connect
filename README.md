# Command Center

## Langkah-langkah Instalasi

1. **Clone Project**

    - Clone project dari repository dengan menggunakan perintah berikut:
        ```bash
        git clone https://github.com/PerdanaKarya/command-center-prov-bengkulu.git
        ```

2. **Install Composer Dependencies**

    - Jalankan perintah berikut untuk menginstal semua dependensi yang diperlukan:
        ```bash
        composer install
        ```
3. **Install NPM Dependencies**

    - Jalankan perintah berikut untuk menginstal semua dependensi yang diperlukan:
        ```bash
        npm install
        ```

3. **Copy dan Paste File .env**

    - Salin semua data dari file `.env.example` dan tempelkan di file `.env`:
        ```bash
        cp .env.example .env
        ```

4. **Generate Project Key**

    - Jalankan perintah berikut untuk menghasilkan kunci proyek:
        ```bash
        php artisan key:generate
        ```
        
5. **Migrate Database**

    - Jalankan perintah berikut untuk migrasi database:
        ```bash
        php artisan migrate
        ```

6. **Jalankan Server Lokal**
    - Terakhir, jalankan perintah berikut untuk menjalankan proyek secara lokal:
        ```bash
        php artisan serve
        ```
   - Setelah itu buka terminal baru dan jalankan:
        ```bash
        npm run dev
        ```
    - Proyek akan berjalan di `http://localhost:8000 || http://127.0.0.1:8000/` secara default.
## Catatan

-   Pastikan Anda memiliki PHP, Composer, dan Laravel CLI yang terinstal di sistem Anda sebelum menjalankan langkah-langkah di atas.
-   Pastikan juga Anda memiliki database yang sudah terbuat dan konfigurasi yang sesuai di file `.env`.
