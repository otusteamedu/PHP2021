#Настройка/запуск

#hosts.example
Добавить содержимое в C:\Windows\System32\drivers\etc\hosts (Windows) или /etc/hosts (Linux)

##docker-compose.yml.example
Изменить, если нужно конфиги, переименовать в docker-compose.yml

##code/redis.test/.env.example
Изменить параметры окружения, переименовать в .env

##Сборка/Запуск контейнеров
docker-compose up -d
docker exec -i app bash -c "cd /data/redis.local/redis.test/ && composer install"
php artisan queue:work

#Тест
Пример запроса:
POST http://redis.local/reports
{"priority": 10, "conditions": { "param1": 1 }, "event": "event2233", "replyType": "email", "replyTo": "some_email@mailhost.com", "subject": "testtest"}

####replyTo - сюда указать e-mail, куда ответ отправлять
