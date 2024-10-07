# Dockerfile
FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Apache config  
COPY apache.conf /etc/apache2/conf-enabled/servername.conf

# Copy your PHP application into the container
COPY src/ /var/www/html/

ENV APACHE_DOCUMENT_ROOT /var/www/html

RUN a2enmod rewrite
