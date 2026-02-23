# -----------------------------
# 1) Build des assets Vite
# -----------------------------
FROM node:20 AS build-assets

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# -----------------------------
# 2) PHP-FPM + Nginx dans un seul conteneur
# -----------------------------
FROM php:8.2-fpm

# IMPORTANT : permettre à PHP-FPM de lire les variables Render
ENV PHP_FPM_CLEAR_ENV=no

# Installer Nginx + dépendances
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev

# Installer extensions PHP
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier le code Laravel
WORKDIR /var/www/html
COPY . .

# Copier les assets buildés
COPY --from=build-assets /app/public/build ./public/build

# Installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Storage link
RUN php artisan storage:link || true

# Permissions
RUN chmod -R 777 storage bootstrap/cache

# Copier config Nginx
COPY nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views && \
    chmod -R 777 storage/framework


# Exposer le port Render
EXPOSE 10000

# Lancer PHP-FPM + Nginx
CMD service nginx start && php-fpm -F

