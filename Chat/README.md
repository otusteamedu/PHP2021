#hosts.example
Добавить содержимое в C:\Windows\System32\drivers\etc\hosts (Windows) или /etc/hosts (Linux)

#chat.local/docker-compose.yml.example
Изменить, если нужно конфиги, переименовать в docker-compose.yml

#chat.local/code/.env.example
Изменить, если нужно конфиги, переименовать в .env

#Сборка/Запуск контейнера
docker-compose up -d
docker exec -i app-chat bash -c "cd /data/chat.local && composer install"

#Запуск чата
Для Windows: winpty docker exec -it app-chat bash
Для Linux: docker exec -it app-chat bash

Запуск сервера:
cd /data/chat.local/bootstrap/ && php app.php server

Запуск коиента:
cd /data/chat.local/bootstrap/ && php app.php client
