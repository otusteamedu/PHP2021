FROM php:7-fpm

RUN apt-get update && apt-get install -y \
        curl \
        zip \
        unzip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libxslt-dev \
        libpq-dev \
        libc-client-dev \
        libkrb5-dev \
        libonig-dev \
        libzip-dev

RUN docker-php-ext-install \
        gd \
        pdo \
        mbstring \
        tokenizer \
        opcache \
        exif \
        pgsql \
        zip \
        xsl \
        mysqli \
        pdo_mysql \
        && pecl install redis && docker-php-ext-enable redis

ADD ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /app