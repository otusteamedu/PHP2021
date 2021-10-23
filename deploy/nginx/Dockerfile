FROM ubuntu:latest

WORKDIR /var/www

RUN apt-get update \
	&&  apt-get install -y nginx

COPY ./hosts/application.local.conf /etc/nginx/sites-enabled/application.local.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]