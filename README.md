#Установка на тест

##hosts.example
Добавить содержимое в C:\Windows\System32\drivers\etc\hosts (Windows) или /etc/hosts (Linux)

##docker-compose.yml.example
Изменить, если нужно конфиги, переименовать в docker-compose.yml

##code/redis.test/.env.example
Изменить параметры окружения, переименовать в .env

##Сборка/Запуск контейнеров
docker-compose up -d
docker exec -it app bash (winpty docker exec -it app bash - для windows)
cd /data/redis.local/redis.test/
composer install


##Тестирование функционала
##Добавление события
POST    http://redis.local/events   {"priority": 10, "conditions": { "param1": 1 }, "event": "event2233"}
##Поиск события
GET     http://redis.local/events   {"params": { "param1": 1, "param2": 2 }}
##Список всех условий
GET     http://redis.local/events/all_conditions
##Список всех событий
GET     http://redis.local/events/all
##Список всех событий
DELETE     http://redis.local/events
##Test-case из ДЗ
1. Заходим в контейнер app: docker exec -it app bash (winpty docker exec -it app bash - для windows)
2. ./vendor/bin/phpunit --testdox ./tests/EventsTest.php