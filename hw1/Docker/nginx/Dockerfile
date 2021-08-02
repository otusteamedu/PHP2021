FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y nginx

COPY ./hosts/docker-burki.test.conf /etc/nginx/sites-enabled/docker-burki.test.conf
WORKDIR /src
VOLUME /src
EXPOSE 80 443
CMD ["nginx", "-g", "daemon off;"]
