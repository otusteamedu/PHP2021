FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    		git \
    		curl \
    		wget \
    		grep \
    		make \
    		libmemcached-dev \
    		zlib1g-dev \
    		libcurl4-gnutls-dev \
    		libgnutls28-dev \
    		libpq-dev \
    		&& pecl install redis-5.3.4 \
    		&& docker-php-ext-enable redis \
    		&& pecl install memcached-3.1.5 \
    		&& docker-php-ext-enable memcached \
    		&& echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
            && echo "extension=memcached.so" > /usr/local/etc/php/conf.d/memcached.ini