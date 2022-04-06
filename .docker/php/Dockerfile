FROM php:7.4-fpm

WORKDIR /var/www/app

RUN apt-get update \
	&& apt-get install -y \
		git \
		curl \
		libzip-dev \
    && docker-php-ext-install -j$(nproc) \
    	sockets \
    && docker-php-ext-configure \
    	sockets --enable-sockets \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer