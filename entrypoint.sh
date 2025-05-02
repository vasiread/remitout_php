#!/bin/sh

# Create necessary directories
mkdir -p /var/www/storage/framework/{sessions,views,cache}
mkdir -p /var/www/bootstrap/cache

# Set permissions
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public/build
chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/public/build

# Run Laravel setup
cd /var/www

# Only run fresh migrations if RESET_DB is set to true
if [ "$RESET_DB" = "true" ]; then
    php artisan migrate:fresh --force
else
    php artisan config:clear 
    php artisan migrate --force
fi

# Cache optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM and Nginx
php-fpm81 -D
nginx -g "daemon off;"