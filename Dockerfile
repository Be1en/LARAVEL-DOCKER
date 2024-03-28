FROM php:8.1-fpm

# Instalación de dependencias para Laravel y Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto
COPY . .

# Asignar permisos y ejecutar npm install y npm run dev
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && npm install

# Comando por defecto para iniciar el servidor de desarrollo de Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
