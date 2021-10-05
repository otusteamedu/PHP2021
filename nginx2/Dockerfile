FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y nginx
COPY config/2appdocker.local.conf /etc/nginx/sites-enabled/2appdocker.local.conf
WORKDIR /src
VOLUME /src
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]