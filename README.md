#hosts.example
Добавить содержимое в C:\Windows\System32\drivers\etc\hosts (Windows) или /etc/hosts (Linux)

#balance.local/docker-compose.yml.example
Изменить, если нужно конфиги, переименовать в docker-compose.yml

#balance.local/code/.env.example
Изменить параметры окружения, переименовать в .env
Если хотим проверить memcached в режиме пула, то оставляем конфиг MEMCACHED_SERVERS=memcached1:11211,memcached2:11211.
Если хотим проверить в режиме production/stand by - MEMCACHED_SERVERS=memcached1:11211 или MEMCACHED_SERVERS=memcached2:11211. 

#Сборка/Запуск контейнеров
docker-compose up -d
docker exec -i app1 bash -c "cd /data/balance.local && composer install"

#Проверка функционала
POST-запросы на URL http://balance.local/. В параметре email передаем строку, которую хотим проверить на то, является ли она email'ом.
