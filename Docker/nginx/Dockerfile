FROM ubuntu:latest

RUN apt-get update \
    && apt-get install -y nginx \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \

COPY hosts/socket-chat-server.local.conf /etc/nginx/sites-enabled/socket-chat.local.conf

WORKDIR /var/www

VOLUME /var/www

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
