FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx
COPY ./hosts/mysite.local.conf /etc/nginx/sites-enabled/default
EXPOSE 80
WORKDIR /var/www
RUN chown -R www-data html
WORKDIR /var/www/html    
CMD ["nginx", "-g", "daemon off;"]
