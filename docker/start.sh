#!/bin/sh
set -e

PORT="${PORT:-8080}"
SERVER_NAME="${SERVER_NAME:-user-registration-t2f4.onrender.com}"

# Configure Apache
sed -i "s/Listen [0-9]*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:.*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

if grep -q "^ServerName" /etc/apache2/apache2.conf; then
  sed -i "s/^ServerName .*/ServerName ${SERVER_NAME}/" /etc/apache2/apache2.conf
else
  echo "ServerName ${SERVER_NAME}" >> /etc/apache2/apache2.conf
fi

# Generate APP_KEY if missing (critical for Render)
if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

# Clear stale caches (important: clear before setting env vars)
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Verify APP_URL is set (critical for asset URLs)
if [ -z "$APP_URL" ]; then
    echo "WARNING: APP_URL is not set! Asset URLs may be incorrect."
    echo "Please set APP_URL in Render environment variables."
else
    echo "APP_URL is set to: $APP_URL"
fi

# Run migrations (idempotent)
php artisan migrate --force

# Verify build assets exist
if [ ! -f /var/www/html/public/build/manifest.json ]; then
    echo "WARNING: Build manifest not found! Assets may not load."
    echo "Build directory contents:"
    ls -la /var/www/html/public/build/ || echo "Build directory does not exist!"
else
    echo "✓ Build assets found"
fi

# Optimize for production (cache AFTER env vars are confirmed)
# Only cache if APP_URL is set, otherwise Laravel will use defaults
if [ -n "$APP_URL" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    echo "✓ Configuration cached with APP_URL: $APP_URL"
else
    echo "⚠ Skipping config cache - APP_URL not set. Using runtime config."
fi

exec apache2-foreground