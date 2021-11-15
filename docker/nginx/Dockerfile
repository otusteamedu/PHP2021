FROM ubuntu:latest  
RUN apt-get update \
    && apt-get install -y nginx  
#RUN addgroup --gid 3000 --system otus_user \
#    && adduser --uid 3000 --system --disabled-login --disabled-password --gid 3000 otus_user
WORKDIR /var/www/html 
CMD ["nginx", "-g", "daemon off;"]