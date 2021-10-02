FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx  
COPY ./hosts/homework.loc.conf /etc/nginx/sites-enabled/homework.loc.conf
WORKDIR /var/www  
VOLUME /data  
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]