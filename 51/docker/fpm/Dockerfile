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
        libmemcached-dev \
        libzip-dev \
        zlib1g-dev \
        && pecl install memcached-3.1.3 \
        && docker-php-ext-enable memcached

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
# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /data

VOLUME /data

CMD ["php-fpm"]
