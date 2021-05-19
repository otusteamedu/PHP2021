FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx  
COPY ./hosts/localhost.conf /etc/nginx/sites-enabled/localhost.conf
WORKDIR /var/www/html
VOLUME /var/www/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]