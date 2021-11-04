FROM ubuntu:latest

RUN apt-get update && apt-get install -y nginx

COPY ./hosts/otus1.local.conf /etc/nginx/sites-enabled/otus1.local.conf

WORKDIR /var/www/otus1.local
VOLUME /var/www/otus1.local
EXPOSE 80

CMD [ "nginx", "-g", "daemon off;"]
