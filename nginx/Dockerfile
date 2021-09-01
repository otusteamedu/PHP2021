FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y nginx
COPY ./config/mysite.local.conf /etc/nginx/sites-enabled/mysite.local.conf
RUN sudo rm -v /etc/nginx/sites-enabled/default
WORKDIR /data
VOLUME /data
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]