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

RUN apt-get update && apt-get install -y curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get install -y git

RUN pecl install xdebug-3.0.0 && docker-php-ext-enable xdebug
RUN #pecl install xdebug-2.9.8 && docker-php-ext-enable xdebug
#RUN apt-get update && apt-get install -y php-xdebug

CMD ["php-fpm"]