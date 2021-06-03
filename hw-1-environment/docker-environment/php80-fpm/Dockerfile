FROM php:8.0-fpm

ARG UID
ARG USERNAME
ARG PATH_LISTEN_SETTINGS=/usr/local/etc/php-fpm.d/zz-docker.conf

RUN addgroup --gid $UID --system $USERNAME \
    && adduser --uid $UID --system --disabled-login --disabled-password \
    --gid $UID \
    $USERNAME


RUN sed -i 's@listen = 9000@listen = /sock/docker.sock@' $PATH_LISTEN_SETTINGS \
    && echo 'listen.owner = '$USERNAME >> $PATH_LISTEN_SETTINGS

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
    && pecl -q install memcached \
        && docker-php-ext-enable memcached \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm"]
