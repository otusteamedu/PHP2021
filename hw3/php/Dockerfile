FROM php:7.4-fpm

RUN apt-get update && docker-php-ext-install -j$(nproc) sockets
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

CMD ["php-fpm"]