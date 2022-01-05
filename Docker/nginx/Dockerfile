FROM nginx:latest

RUN apt-get update \
    && apt-get install -y  \
    nginx  \
    mc \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./hosts/app.local.conf /etc/nginx/conf.d/app.local.conf

WORKDIR /var/www

VOLUME /var/www

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
