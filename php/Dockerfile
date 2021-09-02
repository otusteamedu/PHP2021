FROM php:7.2.13-fpm-alpine

#RUN addgroup -g 1000 -S root
#RUN adduser -u 1000 -S -G root root

#COPY www.conf /usr/local/etc/php-fpm.d/www.conf
#RUN rm /usr/local/etc/php-fpm.d/zz-docker.conf

USER root

CMD ["php-fpm", "--nodaemonize"]