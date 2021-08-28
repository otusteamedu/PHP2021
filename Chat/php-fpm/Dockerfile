FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git

RUN docker-php-ext-install sockets

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /tmp

CMD ["php-fpm"]