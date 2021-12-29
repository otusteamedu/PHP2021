Используя laradoc запустить докер
docker-compose up -d nginx php-fpm nginx php-worker rabbitmq

Переименовать .env.example в .env при необходимости изменить настройки

Запустить обработку очереди php artisan queue:work

На сервер отправляется POST запрос по адресу request. 
В ответ приходит номер запроса.
Пример запроса POST http://localhost/request

Запрос ставиться в очередь.

Узнать статус запроса можно послав get запрос getstatus/{id} с указанием id запроса

Документация доступна по адресу http://localhost:8000/api/documentation


