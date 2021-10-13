#Как развернуть

##code/docker-compose.yml.example
Изменить, если нужно конфиги, переименовать в docker-compose.yml

##Сборка/Запуск контейнеров
docker-compose up -d
docker exec -it app bash
cd /data/patterns.local/
composer install

##Проверка функционала
В контейнере app, после запуска:
cd /data/patterns.local/
php console/index.php
