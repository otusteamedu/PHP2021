FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git
# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN pecl install redis && docker-php-ext-enable redis

WORKDIR /tmp

CMD ["php-fpm"]