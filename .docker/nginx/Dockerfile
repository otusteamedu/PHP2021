FROM ubuntu:latest

RUN apt-get update && apt-get install -y nginx

COPY ./mx-check.local.conf /etc/nginx/sites-enabled/mx-check.local.conf

WORKDIR /var/www/html
VOLUME /var/www/html

CMD [ "nginx", "-g", "daemon off;"]