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
# 2) PHP-FPM pour Laravel
# -----------------------------
FROM php:8.2-fpm

# IMPORTANT : permettre à PHP-FPM de lire les variables Render
ENV PHP_FPM_CLEAR_ENV=no

# Dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev

# Extensions PHP
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Dossier de travail
WORKDIR /var/www/html

# Copier le code Laravel
COPY . .

# Copier les assets buildés
COPY --from=build-assets /app/public/build ./public/build

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Préparer Laravel
RUN php artisan storage:link || true

# Permissions
RUN chmod -R 777 storage bootstrap/cache

# Exposer le port Render
EXPOSE 10000

# Lancer PHP-FPM sur le port 10000
CMD ["php-fpm", "-F", "--nodaemonize", "--fpm-config", "/usr/local/etc/php-fpm.conf"]

