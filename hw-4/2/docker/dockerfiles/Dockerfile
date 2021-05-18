FROM php:8.0-fpm

RUN apt-get update \
    && apt-get install -y git curl wget grep zlib1g-dev libmemcached-dev libpq-dev postgresql libcurl4-openssl-dev libicu-dev libssl-dev \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && pecl install -of redis \
    && docker-php-ext-enable redis \
    && pecl install -of memcached \
    && docker-php-ext-enable memcached \
    && pecl install -of raphf \
    && docker-php-ext-enable raphf \
    && pecl install -of pecl_http \
    && echo "extension=http.so" > /usr/local/etc/php/conf.d/docker-php-ext-http.ini \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install sockets

WORKDIR /var/www/html
VOLUME /var/www/html

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

CMD ["php-fpm"]