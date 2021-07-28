FROM ubuntu:latest  
RUN apt-get update && apt-get install -y nginx  
COPY ./olegsv.local.conf /etc/nginx/sites-enabled/olegsv.local.conf
COPY ./www/olegsv/public/index.php /var/www/olegsv/public/index.php
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]