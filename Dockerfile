# Simple and fast Laravel Docker setup
FROM php:8.1-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Copy application code
COPY . .

# Generate application key
RUN php artisan key:generate

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Configure Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Create startup script
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
echo "Starting Laravel application..."\n\
\n\
# Wait for database to be ready\n\
echo "Waiting for database connection..."\n\
attempts=0\n\
max_attempts=30\n\
\n\
while [ $attempts -lt $max_attempts ]; do\n\
    if php artisan migrate:status > /dev/null 2>&1; then\n\
        echo "Database is ready! Running migrations..."\n\
        php artisan migrate --force\n\
        echo "Caching configuration..."\n\
        php artisan config:cache\n\
        php artisan route:cache\n\
        php artisan view:cache\n\
        echo "Starting Apache..."\n\
        apache2-foreground\n\
        exit 0\n\
    fi\n\
    echo "Database not ready, attempt $((attempts+1))/$max_attempts..."\n\
    sleep 2\n\
    attempts=$((attempts+1))\n\
done\n\
\n\
echo "Database connection failed after $max_attempts attempts"\n\
echo "Starting Apache anyway (migrations may fail)..."\n\
apache2-foreground' > /usr/local/bin/start.sh

RUN chmod +x /usr/local/bin/start.sh

# Expose port
EXPOSE 80

# Start the application
CMD ["/usr/local/bin/start.sh"]