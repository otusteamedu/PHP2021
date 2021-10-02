FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y nginx
COPY hosts/youtube.local.conf /etc/nginx/sites-enabled/youtube.local.conf
WORKDIR /data
VOLUME /data
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
