# Usamos la imagen base de PHP 7.2 con Apache
FROM php:7.2-apache

# Instalamos las extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Habilitamos mod_rewrite
RUN a2enmod rewrite

# Instalamos Composer
RUN apt-get update && apt-get install -y wget git unzip
RUN wget https://getcomposer.org/installer -O composer-installer.php \
    && php composer-installer.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-installer.php

# Copiamos el contenido de la aplicación al directorio del servidor web
COPY . /var/www/html/

# Copiamos la configuración de Virtual Host a Apache
COPY config/vhost.conf /etc/apache2/sites-available/000-default.conf

# Damos permisos adecuados a los archivos copiados
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Ejecutamos Composer para instalar dependencias
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Exponemos el puerto 80
EXPOSE 80
