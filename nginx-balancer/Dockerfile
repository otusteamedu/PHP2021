FROM ubuntu:latest

RUN apt-get update && apt-get install -y nginx

COPY ./hosts/nginx-balancer.local.conf /etc/nginx/sites-enabled/otus.local.conf

WORKDIR /var/www/otus.local
VOLUME /var/www/otus.local
EXPOSE 80

CMD [ "nginx", "-g", "daemon off;"]
