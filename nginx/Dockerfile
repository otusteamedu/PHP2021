FROM nginx:1.15.8-alpine

RUN  apk update
RUN apk add nano

#RUN addgroup -g 1000 -S root
#RUN adduser -u 1000 -S -G root root

COPY app.conf /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf

RUN touch /var/run/nginx.pid \
 && chown -Rf root:root \
    /var/run/nginx.pid \
    /var/cache/nginx \
    /var/log/nginx

USER root