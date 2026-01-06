FROM php:8.3-fpm

# 1) Dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev

RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 2) Installer Node.js pour Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

WORKDIR /var/www/html

COPY . .

# 3) Créer la base SQLite
RUN mkdir -p database && touch database/database.sqlite

# 4) Installer PHP deps
RUN composer install --no-dev --optimize-autoloader

# 5) Installer NPM deps + build Vite
RUN npm install
RUN npm run build

# 6) Dossiers Laravel
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs

# 7) Permissions
RUN chmod -R 777 storage bootstrap/cache database

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 10000

# 8) Migrations au démarrage
CMD ["/entrypoint.sh"]


