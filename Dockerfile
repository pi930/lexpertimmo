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
FROM php:8.2-fpm AS php

ENV PHP_FPM_CLEAR_ENV=no

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev

RUN docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
COPY --from=build-assets /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader

RUN php artisan storage:link || true
RUN chmod -R 777 storage bootstrap/cache


# -----------------------------
# 3) Nginx + PHP-FPM
# -----------------------------
FROM nginx:alpine

# Copier la config Nginx
COPY ./nginx.conf /etc/nginx/nginx.conf

# Copier Laravel et PHP-FPM
COPY --from=php /var/www/html /var/www/html
COPY --from=php /usr/local/etc/php-fpm.d /usr/local/etc/php-fpm.d
COPY --from=php /usr/local/sbin/php-fpm /usr/local/sbin/php-fpm

WORKDIR /var/www/html

EXPOSE 10000

CMD php-fpm -D && nginx -g "daemon off;"

