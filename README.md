#### - выполнить git clone  https://github.com/laradock/laradock.git 

#### - переименовать .env.example в .env и положиить его в laradock

#### - перейти в laradock и запустить
````
docker-compose up php-fpm nginx redis
docker run -v redisinsight:/db -p 8001:8001 redislabs/redisinsight:latest
````
1) В папке code были добавлены сиды для наполнения NoSQl бд:
code/database/seeders

2) Были добавлены репозитории для nosql бд:
code/app/Repositories

3) Был добавлен интерфейс nosql бд:
code/app/Interfaces

4) Добавлена инверсия зависимостей для интерфейса nosql хранилища:
code/app/Providers/AppServiceProvider.php

5) Добавлен конфиг для nosql:
code/config/nosql.php
