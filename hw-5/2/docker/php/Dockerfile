FROM php:8.0-fpm

ARG UID

RUN apt-get update \
    && apt-get install -y vim \
    && addgroup --gid $UID --system app \
    && adduser --uid $UID --system --disabled-login --disabled-password --gid $UID app

ARG SOCKET
COPY zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf
RUN sed  -i "s/docker.sock/$SOCKET.sock/" /usr/local/etc/php-fpm.d/zz-docker.conf