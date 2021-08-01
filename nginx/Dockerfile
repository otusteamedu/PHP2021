FROM nginx

COPY ./hosts/application.local.conf /etc/nginx/conf.d/application.local.conf

WORKDIR /var/www/homework

EXPOSE 80
EXPOSE 443

CMD ["nginx", "-g", "daemon off;"]
