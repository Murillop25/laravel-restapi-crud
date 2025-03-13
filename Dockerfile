# Usamos la imagen oficial de PHP con extensiones necesarias
FROM php:8.2-fpm

# Instalamos dependencias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql gd

# Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuramos el directorio de trabajo
WORKDIR /var/www

# Copiamos el código del proyecto
COPY . .

# Instalamos dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Damos permisos a la carpeta de almacenamiento
RUN chmod -R 777 storage bootstrap/cache

CMD ["php-fpm"]
