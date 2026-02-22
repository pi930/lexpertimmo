#!/usr/bin/env bash
set -e

echo "🚀 Lancement de Laravel sur Render..."

# 1) Attendre que la base soit prête (utile sur Render)
if [ -n "$DB_HOST" ]; then
  echo "⏳ Attente de la base de données..."
  until nc -z "$DB_HOST" "$DB_PORT"; do
    sleep 1
  done
  echo "✔️ Base de données disponible"
fi

# 2) Cache Laravel
echo "🔧 Nettoyage et optimisation du cache Laravel..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan config:cache || true

# 3) Storage link
echo "🔗 Vérification du storage..."
php artisan storage:link || true

# 4) Migrations (optionnel)
if [ "$RUN_MIGRATIONS" = "true" ]; then
  echo "📦 Exécution des migrations..."
  php artisan migrate --force || true
fi

# 5) Lancer Laravel
echo "🌐 Démarrage du serveur Laravel..."
exec php artisan serve --host 0.0.0.0 --port "$PORT"

