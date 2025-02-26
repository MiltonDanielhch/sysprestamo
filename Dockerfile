# Etapa 1: Construcción (Node.js para compilar assets)
FROM node:18 AS build
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Etapa 2: Ejecución (PHP y Apache para servir la aplicación)
FROM webdevops/php-apache:8.2-alpine
WORKDIR /app
COPY --from=build /app /app
RUN chown -R www-data:www-data /app
ENV APACHE_DOCUMENT_ROOT=/app/public
RUN sed -i 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' /etc/apache2/httpd.conf
