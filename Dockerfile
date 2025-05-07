# Stage 1: Build the Laravel backend and frontend assets
FROM php:8.1-fpm AS builder

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    libzip-dev \
    libpq-dev


# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files (excluding node_modules for efficiency)
COPY . .

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev


# Install JavaScript dependencies and build frontend
RUN npm install && npm run build


# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Stage 2: Set up the production image with PHP-FPM and Nginx
FROM php:8.1-fpm-alpine3.17

# Install Nginx and PHP dependencies
RUN apk add --no-cache \
    nginx \
    php81 \
    php81-fpm \
    php81-pdo \
    php81-pdo_mysql \
    php81-pdo_pgsql \
    php81-mbstring \
    php81-gd \
    php81-session \
    php81-tokenizer \
    postgresql-dev


RUN apk add --no-cache openssl && \
    docker-php-ext-install pdo pdo_pgsql

# Copy PHP configuration
# COPY php.ini /etc/php81/conf.d/custom.ini

# Install PHP extensions in production
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Copy PHP-FPM configuration
COPY php-fpm.conf /etc/php81/php-fpm.d/www.conf

# Copy Nginx configuration to overwrite the main nginx.conf
COPY nginx.conf /etc/nginx/nginx.conf

# Copy built files from the builder stage
COPY --from=builder /var/www /var/www
RUN chown -R www-data:www-data /var/www/public/assets
RUN chmod -R 755 /var/www/public/assets

# Copy .env file
COPY .env.production /var/www/.env

# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Set permissions again in case alpine image resets them
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/public


# Expose the port
EXPOSE 80

# Use the entrypoint script to start PHP-FPM and Nginx
ENTRYPOINT ["/entrypoint.sh"]