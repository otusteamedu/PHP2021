FROM ubuntu:latest

RUN apt-get update && apt-get install -y nginx

WORKDIR /data
VOLUME /data
CMD ["nginx", "-g", "daemon off;"]
