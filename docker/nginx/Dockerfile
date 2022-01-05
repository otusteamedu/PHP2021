FROM ubuntu:latest  
RUN apt-get update \
    && apt-get install -y nginx  
WORKDIR /var/www/html 
CMD ["nginx", "-g", "daemon off;"]