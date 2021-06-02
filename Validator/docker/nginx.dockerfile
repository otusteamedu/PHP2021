FROM nginx:alpine

ADD docker/nginx/vhost.conf /etc/nginx/conf.d/default.conf
