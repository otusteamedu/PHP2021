FROM ubuntu:latest

RUN apt-get update && apt-get install -y nginx

COPY ./hosts/trusted-brackets.local.conf /etc/nginx/sites-enabled/trusted-brackets.local.conf

WORKDIR /var/www/trusted-bracets.local
VOLUME /var/www/trusted-bracets.local

CMD [ "nginx", "-g", "daemon off;"]