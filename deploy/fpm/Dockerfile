FROM php:7.4-fpm

WORKDIR /var/www

# Modules
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

# Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY custom.php.ini /usr/local/etc/php/conf.d/custom.php.ini
COPY debug.php.ini /usr/local/etc/php/conf.d/debug.php.ini

CMD ["php-fpm"]
