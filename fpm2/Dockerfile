FROM php:7.4-fpm

RUN apt update
RUN apt install -y git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /src

VOLUME /src

CMD ["php-fpm"]
