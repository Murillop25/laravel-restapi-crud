FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar permisos y usuario
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copiar el código fuente
COPY --chown=www:www . /var/www

# Cambiar al usuario www
USER www

# Establecer directorio de trabajo
WORKDIR /var/www

# Instalar dependencias de PHP (opcional, puedes ejecutarlo manualmente)
# RUN composer install --no-interaction --no-plugins --no-scripts

# Puerto para PHP-FPM
EXPOSE 9000
