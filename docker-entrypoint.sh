#!/bin/sh
set -e

# Wait for database to be ready
echo "Waiting for database connection..."
until php artisan db:show > /dev/null 2>&1; do
    echo "Database is unavailable - sleeping"
    sleep 2
done
echo "Database is up - executing commands"

# Clear Laravel caches
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# Run migrations (only if needed)
php artisan migrate --force

# Run seeders if RUN_SEEDERS env var is set to true
# Set RUN_SEEDERS=true in Render.com env vars for first deploy, then remove it
if [ "$RUN_SEEDERS" = "true" ]; then
    echo "Running seeders..."
    php artisan db:seed --force
else
    echo "Skipping seeders (set RUN_SEEDERS=true to run them)"
fi

# Start the application
exec make start

