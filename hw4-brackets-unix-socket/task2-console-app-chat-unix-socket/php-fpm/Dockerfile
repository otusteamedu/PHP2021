FROM php:7.4-fpm

RUN apt-get update && apt-get install -y curl \
    && docker-php-ext-install sockets

RUN apt-get update && apt-get install -y \
            wget \
            git \
            libfreetype6-dev \
            libjpeg62-turbo-dev \
    	libpng-dev \
    	libonig-dev \
    	libzip-dev \
    	libmcrypt-dev \
        libmemcached11 \
        libmemcachedutil2 \
        libmemcached-dev \
        libz-dev \
            && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
    	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
            && docker-php-ext-install -j$(nproc) gd \
        && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
            && apt-get autoremove -y \
            && rm -rf /var/lib/apt/lists/* \
            && apt-get clean

WORKDIR /data

CMD ["php-fpm"]
