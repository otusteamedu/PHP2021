FROM redis:alpine
COPY ./redis.conf /usr/local/etc/redis/redis.conf
VOLUME /redis-data  
EXPOSE 3306
CMD ["redis-server", "/usr/local/etc/redis/redis.conf"]