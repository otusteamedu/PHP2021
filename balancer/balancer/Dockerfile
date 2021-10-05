FROM nginx:latest
COPY ./hosts/balancer.conf /etc/nginx/sites-enabled/balancer.conf
CMD ["nginx", "-g", "daemon off;"]