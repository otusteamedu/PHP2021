FROM nginx:latest
COPY ./nginx.conf /etc/nginx/nginx.conf
WORKDIR /data
VOLUME /data
EXPOSE 80
CMD [ "nginx", "-g", "daemon off;" ]