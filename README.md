Kenapa Ini Berbahaya?

Pada implementasi Yoga, terdapat beberapa kelemahan serius pada sisi keamanan karena tidak menggunakan fitur dasar keamanan yang sudah disediakan oleh Laravel dengan benar. Proses autentikasi tidak dilakukan secara aman karena hanya mengandalkan email tanpa verifikasi password yang benar. Selain itu, tidak ada sistem authorization sehingga setelah login, semua pengguna bisa mengakses seluruh route tanpa pembatasan hak akses. Lebih parah lagi, password disimpan dalam bentuk plain text tanpa hashing atau enkripsi, sehingga sangat mudah dibaca jika database bocor. Secara keseluruhan, sistem ini hanya berfokus pada fungsi agar berjalan, tanpa mempertimbangkan keamanan yang seharusnya menjadi standar utama.

Dampak Jika Dibiarkan
Akun pengguna dapat diakses atau diambil alih tanpa mengetahui password asli
Pengguna biasa bisa masuk ke halaman admin dan mengubah seluruh data sistem
Jika database bocor, semua password pengguna langsung terbaca karena tidak dienkripsi
Sistem menjadi sangat rentan terhadap penyalahgunaan oleh pihak tidak bertanggung jawab
