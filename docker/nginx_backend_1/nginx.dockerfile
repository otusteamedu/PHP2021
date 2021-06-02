FROM nginx:alpine

ADD docker/nginx_backend_1/nginx.conf /etc/nginx/nginx.conf
ADD docker/nginx_backend_1/vhost.conf /etc/nginx/conf.d/default.conf
