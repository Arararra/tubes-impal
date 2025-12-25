FROM php:8.3-fpm

# System deps
RUN apt-get update && apt-get install -y \
  git \
  unzip \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  libzip-dev \
  libicu-dev \
  zip \
  curl

# PHP extensions
RUN docker-php-ext-install \
  pdo_mysql \
  mbstring \
  exif \
  pcntl \
  bcmath \
  gd \
  zip \
  intl

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Permission
RUN chown -R www-data:www-data /var/www
