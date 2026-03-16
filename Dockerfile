# Utilise une image PHP légère
FROM php:8.2-fpm

# Installe les dépendances système nécessaires
RUN apt-get update && apt-get install -y libpng-dev libzip-dev zip unzip git

# Installe les extensions PHP requises par Laravel
RUN docker-php-ext-install pdo pdo_mysql gd zip

# Installe Composer depuis l'image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définit le répertoire de travail
WORKDIR /var/www/html

# Copie seulement les fichiers de dépendances pour mettre en cache
COPY composer.json composer.lock ./

# Installe les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copie le reste du code
COPY . .

# Expose le port 80
EXPOSE 80

# Commande de démarrage
CMD php artisan serve --host=0.0.0.0 --port=$PORT