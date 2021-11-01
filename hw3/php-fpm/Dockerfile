FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git \
    && docker-php-ext-install sockets pcntl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /data

VOLUME /data

CMD ["php-fpm"]
