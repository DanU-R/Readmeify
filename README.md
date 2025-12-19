<div align='center'>
   <h1>Readmeify</h1>
   <p>Transformasi README Anda menjadi lebih menarik!</p>
   <p>
      <img src='https://img.shields.io/github/last-commit/DanU-R/Readmeify?style=for-the-badge&logo=github&color=blue' alt='Last Commit'>
      <img src='https://img.shields.io/github/license/DanU-R/Readmeify?style=for-the-badge&logo=github&color=green' alt='License'>
      <img src='https://img.shields.io/github/stars/DanU-R/Readmeify?style=for-the-badge&logo=github&color=yellow' alt='Stars'>
   </p>
</div>

## 📖 About
Readmeify adalah alat yang dirancang untuk membantu pengembang dalam membuat dan mengelola file README yang menarik dan informatif untuk proyek mereka. Dengan menggunakan teknologi terbaru seperti PHP dan Laravel, Readmeify menjamin pengalaman pengguna yang mulus dan efisien.

## 🚀 Key Features
* ✅ **Integrasi Laravel**: Memanfaatkan kekuatan framework Laravel untuk kemudahan pengembangan.
* ✅ **Dukungan Blade**: Menggunakan Blade templating engine untuk fleksibilitas dalam presentasi data.
* ✅ **Kustomisasi CSS dengan Tailwind**: Memungkinkan pengguna untuk menyesuaikan tampilan README mereka dengan mudah.
* ✅ **Penggunaan Vite**: Mempercepat proses pengembangan front-end dengan build tool modern.
* ✅ **Dukungan untuk API**: Memudahkan integrasi dengan berbagai API melalui axios.

## 🛠️ Tech Stack
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-EF3B24?style=for-the-badge&logo=laravel&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-4FC08D?style=for-the-badge&logo=vite&logoColor=white)

## ⚙️ Installation
Ikuti langkah-langkah berikut untuk menginstal Readmeify di lingkungan lokal Anda:

1. **Clone Repository**: Langkah ini diperlukan untuk mendapatkan salinan proyek ke sistem lokal Anda.
   ```bash
   git clone https://github.com/DanU-R/Readmeify.git
   ```

2. **Install Dependencies**: Anda perlu menginstal semua perpustakaan PHP dan JS yang diperlukan untuk menjalankan aplikasi ini.
   ```bash
   composer install && npm install
   ```

3. **Environment Setup**: Salin file .env.example untuk mengkonfigurasi kredensial database.
   ```bash
   cp .env.example .env
   ```

4. **Key & Database**: Hasilkan kunci aplikasi dan migrasikan database untuk menyiapkan struktur tabel.
   ```bash
   php artisan key:generate && php artisan migrate
   ```

5. **Serve**: Mulai aplikasi untuk melihatnya di browser Anda.
   ```bash
   npm run build && php artisan serve
   ```

## 🤝 Contributing
Kontribusi sangat diterima! Jika Anda memiliki ide atau perbaikan, silakan buka pull request atau issue.

## 📄 License
Proyek ini dilisensikan di bawah MIT License.