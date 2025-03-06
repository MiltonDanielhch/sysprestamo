# Imagen base de PHP + FPM
FROM php:8.2-fpm

# 1. Instalar dependencias del sistema (incluyendo ZIP)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip  # Añade "zip"

# 2. Copiar código y corregir permisos
COPY . /var/www/html

# 3. Solucionar error de permisos de Git
RUN chown -R www-data:www-data /var/www/html \
    && git config --global --add safe.directory /var/www/html

# 4. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Instalar dependencias (ignorar requisitos de plataforma temporalmente)
RUN composer install --optimize-autoloader --no-dev --ignore-platform-reqs

# 6. Permisos de storage
RUN chmod -R 775 /var/www/html/storage

# 7. Puerto y comando de inicio
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]