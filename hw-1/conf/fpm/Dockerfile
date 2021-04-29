FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
curl \
wget \
git \
libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev \
libonig-dev \
libzip-dev \
libmcrypt-dev \
libmemcached-dev \
&& pecl install mcrypt-1.0.3 \
&& pecl install memcached-3.1.5 \
&& pecl install redis-5.3.4 \
&& docker-php-ext-enable mcrypt \
&& docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install -j$(nproc) gd \
&& docker-php-ext-enable memcached \
&& docker-php-ext-enable redis \
&& echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
&& echo "extension=memcached.so" > /usr/local/etc/php/conf.d/memcached.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
VOLUME /var/www

CMD ["php-fpm"]