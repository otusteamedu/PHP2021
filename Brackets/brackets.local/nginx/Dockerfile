FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y nginx
COPY ./hosts/brackets.local.conf /etc/nginx/sites-enabled/brackets.local.conf
WORKDIR /data
VOLUME /data
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]