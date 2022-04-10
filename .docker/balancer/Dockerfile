FROM ubuntu:latest

WORKDIR /var/www

RUN apt-get update \
	&&  apt-get install -y nginx

COPY ./hosts/trusted-brackets.local.conf /etc/nginx/sites-enabled/trusted-brackets.local.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]