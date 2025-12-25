# Tubes Impal

## Development standard (bisa bertambah jika diperlukan)
1. Gunakan indentation 2 space agar kode tidak terlalu panjang
2. Berikan jarak antar section sehingga tiap bagian mudah dicek
6. Develop sesuai dengan branchnya untuk menghindari conflict atau tabrakan
7. Sebelum push pastikan sudah pull terlebih dahulu
8. PASTIKAN untuk tidak merge ke branch `main` jika fitur belum final dan/atau tanpa konfirmasi bersama

---

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

# To fill database tables
$ php artisan db:seed
```

## Start project
```shell
# Aktifkan main project
$ php artisan serve

# Aktifkan API_HOST
$ php artisan serve --port=8001
```

---

## Unit Test
```shell
# Pastikan project dan API_HOST sudah aktif
$ php artisan test
```
## Dusk Test
```shell
# Install Laravel Dusk
$ php artisan dusk:install

# Run all Dusk test
$ php artisan dusk

# Run spesific Dusk test
$ php artisan dusk tests/Browser/{NamaTest}.php
```

---

## Docker
Sebelumnya pastikan Docker Desktop sudah aktif, ubah setting DB_ di `.env` sesuai dengan `docker-compose.yml`
```shell
# Init docker swarm
$ docker swarm init

# Build image
$ docker build -t laravel-filament-app -f docker/php/Dockerfile .

# Deploy stack
$ docker stack deploy -c docker-compose.yml laravel

# Cek services apakah sudah aktif
docker service ls

# Masuk ke container app
docker exec -it $(docker ps -q -f name=laravel_app) bash

# Setup container app
$ composer install
$ php artisan key:generate
$ php artisan migrate:fresh --seed

# Untuk menghentikan docker gunakan
$ docker stack rm laravel
```
