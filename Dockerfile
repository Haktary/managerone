FROM php:8.2-apache

# Active mod_rewrite pour .htaccess
RUN a2enmod rewrite

# Installer sqlite
#RUN docker-php-ext-install pdo pdo_sqlite
RUN apt-get update && apt-get install -y sqlite3

# Copier notre fichier de conf Apache custom pour activer .htaccess
COPY . /var/www/html/
WORKDIR /var/www/html
RUN chmod 666 /var/www/html/data
RUN chmod 666 /var/www/html/data/database.sqlite


# Configurer Apache pour permettre l'utilisation de .htaccess
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
