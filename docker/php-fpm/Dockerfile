FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
        libmemcached11 \
        libmemcachedutil2 \
        libmemcached-dev \
        libz-dev \
        curl \
        autoconf \
        g++ \
        make \
        git \
        re2c \
    && pecl install -o -f redis \
    && docker-php-ext-enable redis.so \
    && pecl clear-cache \
    && cd /root \
    && git clone https://github.com/php-memcached-dev/php-memcached \
    && cd php-memcached \
    && phpize \
    && ./configure \
    && make \
    && make install \
    && cd .. \
    && rm -rf  php-memcached \
    && echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini \
    && apt-get remove -y build-essential libmemcached-dev libz-dev \
    && apt-get remove -y libmemcached-dev libz-dev \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

WORKDIR /var/www/otus

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
