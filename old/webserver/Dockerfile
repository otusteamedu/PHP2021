FROM ubuntu:latest

RUN apt-get update && apt-get install -y nginx

COPY ./hosts/my-application.local.conf /etc/nginx/sites-enabled/my-application.local.conf

WORKDIR /var/www/my-application.local
VOLUME /var/www/my-application.local
EXPOSE 80

CMD [ "nginx", "-g", "daemon off;"]