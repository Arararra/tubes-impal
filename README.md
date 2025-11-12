# Tubes Impal

## Development standard (bisa bertambah jika diperlukan)
1. Gunakan indentation 2 space agar kode tidak terlalu panjang
2. Berikan jarak antar section sehingga tiap bagian mudah dicek
6. Develop sesuai dengan branchnya untuk menghindari conflict atau tabrakan
7. Sebelum push pastikan sudah pull terlebih dahulu
8. PASTIKAN untuk tidak merge ke branch `main` jika fitur belum final dan/atau tanpa konfirmasi bersama

## Initial setup
Command untuk setup awal, pastikan file `.env` sudah disetup.
```shell
# Install dependency
$ composer install

# To generate APP_KEY in .env
$ php artisan key:generate

# Fresh migrate db schema
$ php artisan migrate:fresh --seed
```

## Pull repo changes
```shell
# Run composer to install packages
$ composer install

# To migrate database changes
$ php artisan migrate
```

## Start project
```shell
$ php artisan serve
```

## Setup entry/resource
Cek resource dan migration yang sudah ada sebagai referensi
1. Buat model baru beserta migrasi
```shell 
php artisan make:model {NamaModel} -m
```
2. Isi migrasi
3. Isi model
4. Migrate file migration yang sudah dibuat tadi
```shell
$ php artisan migrate
```
5. Buat resource filament (namanya samakan dengan model saja)
```shell
$ php artisan make:filament-resource {NamaModel}
```
6. Isi schema (form) dan table sesuai yang dibutuhkan

## Setup API
Cek `app\Http\Controllers\Api\SingleController.php` dan `route/api.php` untuk referensi
1. Buat controller API
`php artisan make:controller Api/{Nama}Controller --api`
2. Tambahkan route di routes/api.php, pastikan endpoint dan model sudah benar
3. Isi controller sesuai kebutuhan
