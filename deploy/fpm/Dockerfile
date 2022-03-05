FROM php:7.4-fpm

WORKDIR /var/www

# Modules
RUN apt-get update \
	&& apt-get install -y \
		git \
		curl \
		libzip-dev \
	&& pecl install \
    	redis-5.3.5 \
		xdebug-2.8.0 \
    && docker-php-ext-enable \
    	redis \
    	xdebug

# Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY custom.php.ini /usr/local/etc/php/conf.d/custom.php.ini
COPY debug.php.ini /usr/local/etc/php/conf.d/debug.php.ini

CMD ["php-fpm"]
