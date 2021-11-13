FROM php:7.4-fpm

WORKDIR /var/www/app

RUN apt-get update \
	&& apt-get install -y \
		git \
		curl \
		libzip-dev \
	&& pecl install \
		xdebug-2.8.0 \
    && docker-php-ext-enable \
    	xdebug \
    && docker-php-ext-install -j$(nproc) \
    	sockets \
    && docker-php-ext-configure \
    	sockets --enable-sockets

#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

CMD ["php-fpm"]