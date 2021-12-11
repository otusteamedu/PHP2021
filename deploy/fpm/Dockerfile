FROM php:7.4-fpm

WORKDIR /var/www

# Modules
RUN apt-get update \
	&& apt-get install -y \
		git \
		curl \
		libzip-dev \
		libevent-dev \
		libmemcached-dev \
	&& pecl install \
    	memcached-3.1.5 \
		xdebug-2.8.0 \
    && docker-php-ext-enable \
    	memcached \
    	xdebug

# Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY custom.php.ini /usr/local/etc/php/conf.d/custom.php.ini
COPY debug.php.ini /usr/local/etc/php/conf.d/debug.php.ini

CMD ["php-fpm"]
