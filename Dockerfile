# Use the official PHP image with Apache
FROM php:8.0.30

# Enable apache mod_rewrite for Laravel
RUN apt-get update -y && apt-get install -y openssl zip unzip git libpq-dev
 

Run curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

Run apt-get update && apt-get install -y libpq-dev

Run docker-php-ext-install pdo pdo_pgsql

Run php -m | grep mbstring

WORKDIR /app

COPY . /app

RUN composer install


CMD php artisan serve --host=0.0.0.0 -port=8080

EXPOSE 8080