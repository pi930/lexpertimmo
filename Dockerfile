FROM php:8.3-fpm

# ---------------------------------------------------------
# 1) Installer les dépendances système nécessaires à Laravel
# ---------------------------------------------------------
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev

# Extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ---------------------------------------------------------
# 2) Définir le dossier de travail
# ---------------------------------------------------------
WORKDIR /var/www/html

# Copier tout le projet Laravel
COPY . .

# ---------------------------------------------------------
# 3) Créer la base SQLite vide
# ---------------------------------------------------------
RUN mkdir -p database && touch database/database.sqlite

# ---------------------------------------------------------
# 4) Installer les dépendances Laravel
# ---------------------------------------------------------
RUN composer install --no-dev --optimize-autoloader

# ---------------------------------------------------------
# 5) Créer les dossiers nécessaires à Laravel
# ---------------------------------------------------------
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs

# ---------------------------------------------------------
# 6) Donner les permissions
# ---------------------------------------------------------
RUN chmod -R 777 storage bootstrap/cache database

# ---------------------------------------------------------
# 7) Exécuter les migrations
# ---------------------------------------------------------
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 10000

# ---------------------------------------------------------
# 8) Exposer le port utilisé par Render
# ---------------------------------------------------------
EXPOSE 10000

# ---------------------------------------------------------
# 9) Lancer Laravel
# ---------------------------------------------------------
CMD php artisan serve --host 0.0.0.0 --port 10000

