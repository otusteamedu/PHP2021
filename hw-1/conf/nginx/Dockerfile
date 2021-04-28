FROM ubuntu:latest

RUN apt-get update
RUN apt-get install -y nginx

COPY ./snikonov.local.conf /etc/nginx/sites-enabled/default

WORKDIR /var/www
VOLUME /var/www

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]