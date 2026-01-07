#!/bin/sh

# Exécuter les migrations
php artisan migrate --force

# Lancer le serveur Laravel
php artisan serve --host 0.0.0.0 --port 10000

