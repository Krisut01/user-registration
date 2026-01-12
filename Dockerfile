# Laravel Dockerfile with Apache for production
FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies (production only)
RUN composer install --optimize-autoloader --no-dev --no-scripts --no-interaction

# Copy application code
COPY . .

# Ensure build directory exists and has correct permissions
RUN mkdir -p /var/www/html/public/build && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/build

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache for Render (use fixed port 8080)
RUN sed -i 's/Listen 80/Listen 8080/g' /etc/apache2/ports.conf

# Configure Apache with proper VirtualHost
RUN echo '<VirtualHost *:8080>\n\
    ServerName user-registration-t2f4.onrender.com\n\
    DocumentRoot /var/www/html/public\n\
    \n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    \n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Expose port 8080 (Render will handle the mapping)
EXPOSE 8080

# Health check for Render
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:8080/ || exit 1

# Start Apache (Render handles port mapping automatically)
CMD apache2-foreground