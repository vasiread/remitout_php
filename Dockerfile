# Use the official PHP image as the base image
FROM php:8.1-fpm

# Set the working directory inside the container
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql gd zip

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the Laravel application files to the container
COPY . /var/www

# Set the proper file permissions
RUN chown -R www-data:www-data /var/www

# Change the current user to www-data
USER www-data

# Expose port 8000 to be used for Laravel development
EXPOSE 8000

# Start the PHP FastCGI Process Manager (FPM)
CMD ["php-fpm"]
