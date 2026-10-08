#!/bin/sh
set -eu

port="${PORT:-10000}"
sed -i "s/10000/${port}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
export APP_URL="${APP_URL:-${RENDER_EXTERNAL_URL:-http://localhost}}"

cd /var/www/html
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
touch database/database.sqlite
chown -R www-data:www-data storage bootstrap/cache database/database.sqlite

php artisan migrate --force
php artisan db:seed --class=ProductSeeder --force

exec apache2-foreground
