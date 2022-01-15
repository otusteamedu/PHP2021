FROM php:8.0-fpm

ARG USER_ID
ARG GROUP_ID

RUN apt-get update && apt-get install -y \
        git \
        curl \
        wget \
        zip \
        unzip \
        libonig-dev \
        libfreetype6-dev \
    # Clear cache
    && docker-php-ext-install sockets \
    && apt-get clean \
    && rm -r /var/lib/apt/lists/*

RUN wget https://getcomposer.org/installer -O - -q \
        | php -- --install-dir=/bin --filename=composer --quiet

RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

WORKDIR /var/www

USER "${USER_ID}:${GROUP_ID}"
USER $user