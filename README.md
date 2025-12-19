<div align='center'>
   <h1>Readmeify</h1>
   <p>Transformasi pembacaan dokumentasi yang lebih baik.</p>
   <p>
      <img src='https://img.shields.io/github/last-commit/DanU-R/Readmeify?style=for-the-badge&logo=github&color=blue' alt='Last Commit'>
      <img src='https://img.shields.io/github/license/DanU-R/Readmeify?style=for-the-badge&logo=github&color=green' alt='License'>
      <img src='https://img.shields.io/github/stars/DanU-R/Readmeify?style=for-the-badge&logo=github&color=yellow' alt='Stars'>
   </p>
</div>

## 📖 About
Readmeify adalah sebuah alat yang dirancang untuk membantu pengembang dalam membuat dan mengelola dokumentasi proyek dengan lebih efisien. Dengan memanfaatkan framework Laravel dan teknologi modern lainnya, Readmeify memungkinkan pengguna untuk menghasilkan README.md yang informatif dan menarik dengan cepat.

## 🚀 Key Features
* ✅ **Integrasi Laravel**: Memanfaatkan kekuatan Laravel untuk pengembangan aplikasi yang cepat dan efisien.
* ✅ **Dukungan Tailwind CSS**: Menggunakan Tailwind CSS untuk styling yang responsif dan modern.
* ✅ **Generasi Otomatis**: Fitur untuk menghasilkan bagian-bagian README.md secara otomatis berdasarkan konfigurasi yang diberikan.
* ✅ **Dukungan PHP dan JavaScript**: Mengelola dependensi dengan mudah menggunakan Composer dan npm.
* ✅ **Pengujian yang Efisien**: Menggunakan Faker dan Laravel Tinker untuk pengujian yang lebih baik dan lebih cepat.

## 🛠️ Tech Stack
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-EF3B24?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Vite](https://img.shields.io/badge/Vite-4FC08D?style=for-the-badge&logo=vite&logoColor=white)

## ⚙️ Installation
Ikuti langkah-langkah di bawah ini untuk menginstal Readmeify di lingkungan pengembangan Anda.

1. **Clone Repository**: Langkah ini diperlukan untuk mendownload salinan kode sumber proyek ke komputer Anda.
   ```bash
   git clone https://github.com/DanU-R/Readmeify.git
   ```

2. **Install Dependencies**: Anda perlu menginstal semua dependensi PHP dan JS yang diperlukan untuk menjalankan proyek ini.
   ```bash
   composer install && npm install
   ```

3. **Environment Setup**: Salin file contoh konfigurasi lingkungan untuk mengatur kredensial database Anda.
   ```bash
   cp .env.example .env
   ```

4. **Key & Database**: Hasilkan kunci aplikasi dan lakukan migrasi database untuk menyiapkan tabel yang diperlukan.
   ```bash
   php artisan key:generate && php artisan migrate
   ```

5. **Serve**: Jalankan perintah ini untuk memulai aplikasi dan melihatnya di browser Anda.
   ```bash
   npm run build && php artisan serve
   ```

## 🤝 Contributing
Kontribusi sangat diharapkan! Silakan ajukan permintaan tarik (pull request) atau laporkan masalah (issues) untuk membantu meningkatkan proyek ini.

## 📄 License
Proyek ini dilisensikan di bawah MIT License.