FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx  
COPY ./hosts/app.local.conf /etc/nginx/sites-enabled/app.local.conf
WORKDIR /data  
VOLUME /data
CMD ["nginx", "-g", "daemon off;"]