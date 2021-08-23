FROM php:7.4-fpm

# ставим необходимые для нормальной работы модули
RUN apt-get update && apt-get install -y \
		curl \
		wget \
		git \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libmemcached-dev \
		zlib1g-dev \
		libpng-dev \
		libonig-dev \
		libzip-dev \
		libmcrypt-dev \
		libpq-dev 
		
RUN pecl install mcrypt-1.0.4
RUN docker-php-ext-enable mcrypt 

RUN docker-php-ext-install -j$(nproc) iconv 
RUN docker-php-ext-install -j$(nproc) mbstring
RUN docker-php-ext-install -j$(nproc) mysqli
RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-install -j$(nproc) zip 
RUN docker-php-ext-install -j$(nproc) sockets 

RUN pecl install memcached-3.1.5 
RUN docker-php-ext-enable memcached

WORKDIR /data

VOLUME /data

CMD ["php-fpm"]
