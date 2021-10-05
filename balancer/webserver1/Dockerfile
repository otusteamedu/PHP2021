FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx  
COPY ./hosts/app.conf /etc/nginx/sites-enabled/app.conf
WORKDIR /var/www  
VOLUME /var/www  
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]