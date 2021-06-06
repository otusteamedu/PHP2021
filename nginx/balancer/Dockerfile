FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx  
COPY ./upstream/upstreams.conf /etc/nginx/conf.d/upstreams.conf
COPY ./hosts/localhost.conf /etc/nginx/sites-enabled/localhost.conf
WORKDIR /var/www/html
VOLUME /var/www/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
