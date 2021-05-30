FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx  
COPY ./hosts/backend2.application.local.conf /etc/nginx/sites-enabled/backend2.application.local.conf
WORKDIR /code  
VOLUME /code  
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]