FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y nginx
RUN apt-get install -y nano

RUN chmod -R 777 /var/run/

WORKDIR /var/www
VOLUME /var/www
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]