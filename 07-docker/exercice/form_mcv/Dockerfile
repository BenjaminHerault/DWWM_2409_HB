FROM php:8.2-apache

# Active mod_rewrite si besoin
RUN a2enmod rewrite

# Installe les extensions nécessaires pour PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copie ton projet dans le conteneur
COPY . /var/www/html

# Donne les bons droits
RUN chown -R www-data:www-data /var/www/html
