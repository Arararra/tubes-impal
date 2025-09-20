# Tubes Impal

## Standard frontend templating
1. Gunakan indentation 2 space agar mudal dibaca
2. Berikan jarak antar section sehingga tiap bagian mudah dicek
3. Pastikan routing sudah benar
4. Layouts digunakan untuk container template dengan layout yang relatif mirip (header & footer)
5. Gunakan includes jika section dirasa terlalu panjang atau untuk kebutuhan modular (product card dan sebagainya)

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
```

## Start project
```shell
$ php artisan serve
```

## Setup entry/resource
1. Buat model baru beserta migrasi
`php artisan make:model IniTest -m`
2. Isi migrasi sesuai kebutuhan (https://laravel.com/docs/12.x/migrations)
3. Isi model
4. Migrate file migration yang sudah dibuat tadi
`php artisan migrate`
5. Buat resource filament (namanya samakan dengan model saja)
`php artisan make:filament-resource IniTest`
6. Isi schema (form) dan table sesuai yang dibutuhkan