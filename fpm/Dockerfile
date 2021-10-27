FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libonig-dev \
        libzip-dev \
        libmcrypt-dev \
        libmemcached-dev\
        libmemcached-tools\
        libzip-dev\
        libyaml-dev\
    && pecl install mcrypt \
    && docker-php-ext-enable mcrypt \
    && pecl install memcached\
    && docker-php-ext-enable memcached\
    && docker-php-ext-install sockets\
    && docker-php-ext-enable sockets\
    && pecl install yaml-2.2.1 && echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini\
    && rm -rf /tmp/pecl \



RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /data

VOLUME /data

CMD ["php-fpm"]
