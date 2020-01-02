# Project KP
project KP, merukapan aplikasi berbasis website yang saya buat pada waktu melakukan internship, project ini dibuat menggunakan Framework codeigniter 3
sisi pengguna
* seller(penyedia hotel)
    * membuat halaman hotel dan dapat memanajemenya
    * mengelola transaksi penyewaan kamar
* customer(penyewa hotel)
    * melakukan penyewaan kamar

# installation

* download kemudian pindahkan ke webserver
* pastikan composer telah terinstal, kemudian alankan komposer install
* buka file config.php pada directory config, lalu sesuaikan base urlnya
    ``` 
        // example
        $config['base_url'] = 'http://localhost/Framework/resourceCI/projectKP/';
    ```
* buka file database.php setelah itu ubah dan sesuaikan konfigurasinya
