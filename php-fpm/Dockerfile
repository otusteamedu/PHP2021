FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git
# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql

WORKDIR /tmp

CMD ["php-fpm"]