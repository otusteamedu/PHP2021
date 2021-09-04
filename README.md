#hosts.example
Добавить содержимое в C:\Windows\System32\drivers\etc\hosts (Windows) или /etc/hosts (Linux)

#balance.local

##balance.local/docker-compose.yml.example
Изменить, если нужно конфиги, переименовать в docker-compose.yml

##balance.local/code/.env.example
Изменить параметры окружения, переименовать в .env
Настроена реплика memcached1 (master) -> memcached2 (slave)
При работе можно в .env поменять MEMCACHED_SERVERS=memcached1:11211 на MEMCACHED_SERVERS=memcached2:11211, кешированные данные останутся.

Как проверить:
1. Сделать запрос при MEMCACHED_SERVERS=memcached1:11211. (пример: параметр email, переданный в запросе - md_er@mail.ru)
2. выполнить команду: docker exec -i memcached1 bash -c "apt-get update && apt-get install telnet && telnet 127.0.0.1 11211"
3. выполнить команду: get b6273e580ad4c9c47860c8ab4d755943, увидеть результат
4. выполнить команду: docker exec -i memcached2 bash -c "apt-get update && apt-get install telnet && telnet 127.0.0.1 11211"
5. выполнить команду: get b6273e580ad4c9c47860c8ab4d755943, увидеть результат
6. b6273e580ad4c9c47860c8ab4d755943 - вычисляется как md5($_ENV["MEMCACHED_NAMESPACE"] . "." . $email). - Это если нужно протестировать другой e-mail.



##Сборка/Запуск контейнеров
docker-compose up -d
docker exec -i app1 bash -c "cd /data/balance.local && composer install"

##Проверка функционала
POST-запросы на URL http://balance.local/. В параметре email передаем строку, которую хотим проверить на то, является ли она email'ом.

#session.local

##session.local/docker-compose.yml.example
Изменить, если нужно конфиги, переименовать в docker-compose.yml

##session.local/code/test-app/.env.example
Изменить параметры окружения, переименовать в .env

docker-compose up -d
docker exec -i app1 bash -c "cd /data/session.local/test-app && composer install"
docker exec -i app1 bash -c "cd /data/session.local/test-app && php artisan migrate"

##Проверка функционала
http://session.local/
Регистрируемся/логинимся.