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
# 2) Image PHP pour Laravel
# -----------------------------
FROM php:8.2-cli

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
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring zip exif pcntl bcmath

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

# Lancer Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]

