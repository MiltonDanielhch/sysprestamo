# Imagen base PHP 8.2 FPM
FROM php:8.2-fpm

# 1. Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    netcat-openbsd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 2. Configurar usuario y directorio de trabajo
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www && \
    mkdir -p /var/www/html && \
    chown www:www /var/www/html

WORKDIR /var/www/html

# 3. Copiar código de la aplicación
COPY --chown=www:www . .

# 4. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Instalar dependencias de producción
RUN composer install --optimize-autoloader --no-dev --no-interaction

# 6. Configurar permisos
RUN chmod -R 775 storage bootstrap/cache

# 7. Copiar script de entrada
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# 8. Puerto de la aplicación
EXPOSE 8000

# 9. Comando de inicio
ENTRYPOINT ["docker-entrypoint.sh"]