FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx  
COPY ./hosts/backend1.application.local.conf /etc/nginx/sites-enabled/backend1.application.local.conf
WORKDIR /code  
VOLUME /code  
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]