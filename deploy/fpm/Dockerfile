FROM php:7.4-fpm

WORKDIR /var/www

# Modules
RUN apt-get update \
	&& apt-get install -y \
		git \
		curl \
		wget \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		libonig-dev \
		libzip-dev \
		libmcrypt-dev \
		libmemcached-dev \
	&& pecl install \
		mcrypt-1.0.3 \
		memcached-3.1.5 \
		redis-5.1.1 \
	&& docker-php-ext-enable \
		mcrypt \
		memcached \
		redis \
    && docker-php-ext-install -j$(nproc) \
    	iconv \
    	mbstring \
    	mysqli \
    	pdo_mysql \
    	zip \
	&& docker-php-ext-configure \
		gd --with-freetype --with-jpeg \

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm"]
