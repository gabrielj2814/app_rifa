# con fpm
# FROM php:8.2-fpm

# # Instalar dependencias
# RUN apt-get update && apt-get install -y \
#     git \
#     curl \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     unzip

# # Instalar extensiones de PHP
# RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# # Instalar Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Directorio de trabajo
# WORKDIR /var/www/html

# # Copiar código
# COPY . .

# # Instalar dependencias
# RUN composer install --no-dev --optimize-autoloader

# # Configurar permisos
# RUN chown -R www-data:www-data /var/www/html/storage \
#     && chmod -R 775 /var/www/html/storage

# # Puerto de PHP-FPM
# EXPOSE 9000

# # Comando para iniciar PHP-FPM
# CMD ["php-fpm"]

# con alpine
FROM php:8.2-fpm-alpine

# Instalar dependencias en Alpine
RUN apk update && apk add \
    git \
    curl \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    postgresql-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar código
COPY . .

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

# Puerto de PHP-FPM
EXPOSE 9000

# Comando para iniciar PHP-FPM en Alpine
CMD ["php-fpm", "--nodaemonize"]
