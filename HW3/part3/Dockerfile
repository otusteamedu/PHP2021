FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        grep \
        libcurl4-openssl-dev \
        libicu-dev \
        libssl-dev \
        libpq-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
	    libpng-dev \
	    libonig-dev \
	    libzip-dev \
	    libmcrypt-dev \
        libmemcached-dev \
        && pecl install mcrypt \
	    && docker-php-ext-enable mcrypt \
        && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
	    && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd \
        && pecl install memcached \
        && docker-php-ext-enable memcached \
        && pecl install -of redis \
        && docker-php-ext-enable redis \
        && pecl install -of raphf \
        && docker-php-ext-enable raphf \
        && pecl install -of pecl_http \
        && echo "extension=http.so" > /usr/local/etc/php/conf.d/docker-php-ext-http.ini \
        && docker-php-ext-install pdo_pgsql \
        && docker-php-ext-enable pdo_pgsql


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /data

VOLUME /data

CMD ["php-fpm"]


