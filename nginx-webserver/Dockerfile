FROM ubuntu:latest

RUN apt-get update && apt-get install -y nginx

COPY ./hosts/mysite.conf /etc/nginx/sites-enabled/mysite.conf

WORKDIR /var/www/mysite.local
VOLUME /var/www/mysite.local
EXPOSE 80

CMD [ "nginx", "-g", "daemon off;"]