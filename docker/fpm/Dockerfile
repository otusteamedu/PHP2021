FROM php:7.4-fpm

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
	    libmemcached-dev \
    && pecl install mcrypt-1.0.3 \
        && docker-php-ext-enable mcrypt \
    && pecl install memcached \
        && docker-php-ext-enable memcached \
    && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install -o -f redis \
        && rm -rf /tmp/pear \
        && docker-php-ext-enable redis \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /data
VOLUME /data
CMD ["php-fpm"]
