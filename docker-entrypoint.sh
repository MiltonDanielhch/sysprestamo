#!/bin/sh

# Esperar a que MySQL esté listo (ajusta el nombre del servicio según Coolify)
while ! nc -z ${DB_HOST} 3306; do
  echo "Esperando a MySQL..."
  sleep 2
done

# Ejecutar migraciones y seeders
php artisan migrate --force
php artisan db:seed --force

# Limpiar caché
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar servidor
exec php artisan serve --host=0.0.0.0 --port=8000