Используя laradoc запустить докер
docker-compose up -d nginx php-fpm nginx php-worker rabbitmq

Переименовать .env.example в .env при необходимости изменить настройки

Запустить обработку очереди php artisan queue:work

На сервер отправляется POST запрос с параметром email для отправки ответа
Пример запроса POST http://localhost/?email=test@test.com

Запрос ставиться в очередь и после его обработки отправляется письмо


