FROM php:7.4-fpm

WORKDIR /var/www

RUN apt-get update \
	&& apt-get install -y \
		git \
		curl \
		libzip-dev \
    	libpq-dev \
	&& pecl install \
		xdebug-2.8.0 \
    && docker-php-ext-install -j$(nproc) \
    	pdo_pgsql \
    && docker-php-ext-enable \
    	xdebug \
    && docker-php-ext-configure \
    	pgsql -with-pgsql=/usr/local/pgsql


ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /var/www
VOLUME /var/www

CMD ["php-fpm"]
