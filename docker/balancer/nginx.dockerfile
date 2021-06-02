FROM nginx:alpine

ADD docker/balancer/nginx.conf /etc/nginx/nginx.conf
