FROM php:7.4-fpm

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

RUN pecl install -o redis && docker-php-ext-enable redis
RUN apt-get update && apt-get install -y git

CMD ["php-fpm"]
