FROM php:8-fpm

# ставим необходимые для нормальной работы модули
RUN apt-get update && apt-get install -y \
        apt-utils \
        curl \
        wget \
        git \
        bash \
        zip unzip \
        sendmail \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        icu-devtools \
        libicu-dev \
        libmcrypt4 \
        libmcrypt-dev \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        graphviz \
        libcurl4-openssl-dev \
        pkg-config \
        libldap2-dev \
        libpq-dev \
        libz-dev \
    && apt-get clean

RUN docker-php-ext-configure intl --enable-intl && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-install pdo \
        pgsql pdo_pgsql \
        intl iconv mbstring \
        zip pcntl \
        exif opcache \
    && docker-php-source delete

ENV PHPREDIS_VERSION 5.3.4

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /data

RUN chown -R www-data:www-data /data

VOLUME /data

CMD ["php-fpm"]
