FROM php:7.4-apache

# Install ekstensi yang dibutuhkan
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql

# Aktifkan mod_rewrite Apache untuk CodeIgniter
RUN a2enmod rewrite

# Konfigurasi Apache untuk mengizinkan akses
RUN echo "<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html
