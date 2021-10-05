#Установка на тест

##docker-compose.yml.example
Изменить, если нужно конфиги, переименовать в docker-compose.yml

##code/.env.example
Изменить параметры окружения, переименовать в .env

##Сборка/Запуск контейнеров
docker-compose up -d
docker exec -it app bash (winpty docker exec -it app bash - для windows)
cd /data/database.patterns/
composer install

##Тестирование функционала
cd /data/database.patterns/
./vendor/bin/phpunit --testdox ./tests/OrdersTest.php