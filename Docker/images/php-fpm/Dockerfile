FROM php:8.0-fpm

ARG USER_ID
ARG GROUP_ID

RUN apt-get update && apt-get install -y \
        git \
        curl \
        wget \
        zip \
        unzip \
        libonig-dev \
        libfreetype6-dev \
        libz-dev \
        libmemcached-dev \
    # Install xdebug
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    # Install memcached
    && pecl install memcached \
    && docker-php-ext-enable memcached \
    # Install PDO
    && docker-php-ext-install pdo_mysql \
    # Install redis
    && pecl install -o -f redis \
    && echo "extension=redis.so" >> /usr/local/etc/php/php.ini \
    # Clear cache
    && apt-get clean \
    && rm -r /var/lib/apt/lists/* \
    && wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet

RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

COPY ./conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY ./conf.d/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

WORKDIR /var/www

USER "${USER_ID}:${GROUP_ID}"
USER $user