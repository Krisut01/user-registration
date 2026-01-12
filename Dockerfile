# Laravel production image with Apache
FROM php:8.3-apache

# System deps + PHP extensions
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

# Node.js 20 (for Vite build)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    ln -sf /usr/bin/node /usr/local/bin/node && \
    ln -sf /usr/bin/npm /usr/local/bin/npm && \
    ln -sf /usr/bin/npx /usr/local/bin/npx

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install PHP deps early for cache reuse
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-dev --no-scripts --no-interaction

# Install Node deps early for cache reuse
COPY package.json package-lock.json ./
RUN npm ci --legacy-peer-deps

# Copy application code
COPY . .

# Remove any baked caches from local dev
RUN rm -f bootstrap/cache/*.php

# Build frontend assets
RUN npm run build

# Permissions
RUN mkdir -p /var/www/html/public/build && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/build

# Apache setup (DocumentRoot stays public)
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    a2enmod rewrite

# Start script will set the port and server name at runtime
COPY docker/start.sh /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

# Expose default Render port (overridden at runtime if needed)
EXPOSE 8080

HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:${PORT:-8080}/ || exit 1

CMD ["start-container"]