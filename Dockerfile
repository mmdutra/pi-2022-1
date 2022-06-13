FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY ./composer.* /var/www/
COPY . /var/www/

RUN composer install --no-autoloader

RUN composer dump-autoload -a \
    && mkdir -p /app/storage/logs \
    && rm -f /app/storage/logs/app.log \
    && touch /app/storage/logs/app.log \
    && chown -R www-data:www-data /app

CMD php -S 0.0.0.0:$PORT -t public/

EXPOSE $PORT
