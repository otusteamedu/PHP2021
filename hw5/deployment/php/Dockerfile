FROM php:8.0.2-fpm-alpine3.13

RUN apk upgrade --update && apk add --no-cache \
    libpng-dev \
    libzip-dev \
    libwebp-dev \
    libjpeg-turbo-dev \
    libpng-dev libxpm-dev \
    freetype-dev \
    icu-dev \
    libpq \
    imagemagick \
    build-base \
    zlib-dev \
    php7-dev \
    curl \
    libmemcached-dev \
    yaml-dev

RUN pecl install memcached && \
    pecl install yaml && \
    rm -rf /tmp/pear

RUN docker-php-ext-configure gd && \
    docker-php-ext-install zip gd && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    docker-php-ext-enable yaml && \
    docker-php-ext-enable memcached

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
