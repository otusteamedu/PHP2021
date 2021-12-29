#### - выполнить git clone  https://github.com/laradock/laradock.git 

#### - переименовать .env.example в .env и положиить его в laradock

#### - перейти в laradock и запустить
````
docker-compose up php-fpm nginx redis
docker run -v redisinsight:/db -p 8001:8001 redislabs/redisinsight:latest
````

