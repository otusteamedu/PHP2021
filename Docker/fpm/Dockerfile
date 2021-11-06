FROM php:latest

# ставим необходимые для нормальной работы модули
RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
	    libpng-dev \
        imagemagick \
	    libonig-dev \
	    libzip-dev \
	    libmcrypt-dev \
	    libmemcached-dev\
	    libmemcached-tools\
        mc\
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
        && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
        && pecl install mcrypt-1.0.4 \
	    && docker-php-ext-enable mcrypt \
        && docker-php-ext-install -j$(nproc)  \
        iconv  \
        mbstring  \
        mysqli  \
        pdo_mysql  \
        zip \
	    && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd \
        && pecl install memcached\
        && docker-php-ext-enable memcached\
        && pecl install -o -f redis \
        && docker-php-ext-enable redis\
        && rm -rf /tmp/pear

WORKDIR /var/www

VOLUME /var/www

RUN chown www-data:www-data /var/www

CMD ["php-fpm"]
