FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx  
COPY ./hosts/ap.local.conf /etc/nginx/sites-enabled/ap.local.conf
#COPY ./hosts/ap.local.conf /etc/nginx/sites-enabled/default
#COPY ./hosts/ap.local.conf /etc/nginx/conf.d/
WORKDIR /data  
VOLUME /data  
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]