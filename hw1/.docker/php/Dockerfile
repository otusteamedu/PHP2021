FROM php:7.4-fpm
LABEL maintainer="Dmitrii Grishin"
RUN apt-get update && \
    apt-get install -y \
        curl \
        wget \
        git \
        zlib1g-dev \
        libzip-dev \
        libonig-dev \
        unzip \
        libwebp-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libxpm-dev \
        libfreetype6-dev \
        libmcrypt-dev \
        && pecl install mcrypt-1.0.3 \
	    && docker-php-ext-enable mcrypt \
        && docker-php-ext-install -j$(nproc) iconv mysqli pdo_mysql zip mbstring \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd
VOLUME /srv/code/
WORKDIR /srv/code/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chown -R www-data:www-data /srv/code