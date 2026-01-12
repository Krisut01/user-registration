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

# Clear stale caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run migrations (idempotent)
php artisan migrate --force

exec apache2-foreground