FROM php:8-fpm

#Install xdebug
RUN pecl install xdebug-3.0.4 && docker-php-ext-enable xdebug

# ставим необходимые для нормальной работы модули
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
    libmemcached11 \
    libmemcachedutil2 \
    libmemcached-dev \
    libz-dev \
        && pecl install redis-5.3.4 \
	&& docker-php-ext-enable redis \
        && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd \

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


# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /data

VOLUME /data

CMD ["php-fpm"]
