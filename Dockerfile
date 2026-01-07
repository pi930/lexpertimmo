# -----------------------------
# 1) Build des assets avec Node
# -----------------------------
FROM node:20 AS build-assets

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# -----------------------------
# 2) Image PHP pour Laravel
# -----------------------------
FROM php:8.2-fpm

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
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Dossier de travail
WORKDIR /var/www/html

# Copier le code Laravel
COPY . .

# Copier les assets buildés
COPY --from=build-assets /app/public/build ./public/build

# Base SQLite
RUN mkdir -p database && touch database/database.sqlite

# Dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Dossiers Laravel
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs

# Permissions
RUN chmod -R 777 storage bootstrap/cache database

# Entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 10000

CMD ["/entrypoint.sh"]

