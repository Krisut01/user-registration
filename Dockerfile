# Laravel Dockerfile with Apache for production
FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    gnupg \
    ca-certificates \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 20 LTS using official NodeSource setup
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm --version \
    && node --version \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer 

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (for better Docker layer caching)
COPY composer.json composer.lock ./

# Install PHP dependencies (production only)
RUN composer install --optimize-autoloader --no-dev --no-scripts --no-interaction

# Copy package files for npm (for better Docker layer caching)
COPY package*.json ./
COPY vite.config.js postcss.config.js tailwind.config.js ./

# Install Node.js dependencies with legacy peer deps flag for compatibility
RUN npm ci --legacy-peer-deps --verbose

# Copy application code
COPY . .

# Build frontend assets
RUN echo "=== Starting Vite build ===" \
    && npm run build -- --logLevel verbose \
    && echo "=== Build completed successfully ===" \
    && ls -la public/build/ \
    && echo "=== Checking manifest ===" \
    && cat public/build/manifest.json \
    && echo "=== Verifying CSS file ===" \
    && ls -lh public/build/assets/*.css \
    && echo "=== Verifying JS file ===" \
    && ls -lh public/build/assets/*.js

# Set permissions and ensure build directory exists
RUN mkdir -p /var/www/html/public/build/assets \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/build

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache
RUN echo "ServerName user-registration-w4es.onrender.com" >> /etc/apache2/apache2.conf

# Configure Apache DocumentRoot
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Configure Apache for Render (use fixed port 8080)
RUN sed -i 's/Listen 80/Listen 8080/g' /etc/apache2/ports.conf
RUN sed -i 's/:80/:8080/g' /etc/apache2/sites-available/000-default.conf

# Expose port 8080 (Render will handle the mapping)
EXPOSE 8080

# Health check for Render
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:8080/ || exit 1

# Start Apache (Render handles port mapping automatically)
CMD apache2-foreground