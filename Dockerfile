# Dockerfile

FROM php:8.2-apache

# Instala dependências
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    mariadb-client \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilita o mod_rewrite do Apache (essencial para Laravel)
RUN a2enmod rewrite

# Define o diretório de trabalho
WORKDIR /var/www/html

# Altera o DocumentRoot do Apache para /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
