FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx
RUN apt-get install -y mc
COPY ./config/appdocker.local.conf /etc/nginx/sites-enabled/appdocker.local.conf
WORKDIR /src
VOLUME /src  
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]