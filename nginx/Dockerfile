FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y nginx
RUN apt-get install -y nano

RUN mkdir "/socket"

RUN chmod -R 777 /socket
#RUN touch /var/run/nginx.pid
#RUN chmod -R 777 /var/run/nginx.pid

RUN chown -R root:root /socket

WORKDIR /var/www
VOLUME /var/www
EXPOSE 80

USER root

CMD ["nginx", "-g", "daemon off;"]