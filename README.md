# Tubes Impal

## Initial setup
Command to run on the first time setup, make sure to set `.env` file beforehand.
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