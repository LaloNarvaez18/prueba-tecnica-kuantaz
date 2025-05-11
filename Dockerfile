FROM php:8.1-fpm

# Instalar dependencias de sistema
RUN apt-get update && apt-get install -y \
    zip unzip curl git libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www
RUN composer install --no-interaction \
    && composer require darkaonline/l5-swagger --no-interaction
