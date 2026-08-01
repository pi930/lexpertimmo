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
# 2) PHP + Composer + Extensions
# -----------------------------
FROM php:8.2-fpm AS php-stage

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libxml2-dev libzip-dev

RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath
RUN docker-php-ext-install pdo_pgsql pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
COPY --from=build-assets /app/public ./public

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs
RUN chmod -R 777 storage bootstrap/cache


# -----------------------------
# 3) Caddy (serveur HTTP final)
# -----------------------------
FROM caddy:2.7.4

COPY --from=php-stage /usr/local/sbin/php-fpm /usr/local/sbin/php-fpm
COPY --from=php-stage /var/www/html /var/www/html

COPY Caddyfile /etc/caddy/Caddyfile

EXPOSE 10000

CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile"]
