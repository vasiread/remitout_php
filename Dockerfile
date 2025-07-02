FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www
# Copy built assets from Node stage


# Copy existing application directory contents
COPY . /var/www

# Copy built assets from Node stage
COPY --from=node-builder /app/public /var/www/public
COPY --from=node-builder /app/resources /var/www/resources

# Use production .env by default; override with build arg if needed
ARG ENV_FILE=.env.production
COPY ${ENV_FILE} /var/www/.env

# Install Laravel dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
