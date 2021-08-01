FROM nginx

COPY ./hosts/app.local.conf /etc/nginx/conf.d/app.local.conf

WORKDIR /var/www/homework

EXPOSE 80
EXPOSE 443

CMD ["nginx", "-g", "daemon off;"]
