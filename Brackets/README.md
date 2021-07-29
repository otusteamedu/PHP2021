#hosts.example
Добавить содержимое в C:\Windows\System32\drivers\etc\hosts (Windows) или /etc/hosts (Linux)

#brackets.local/docker-compose.yml.example
Изменить, если нужно конфиги, переименовать в docker-compose.yml

#Сборка/Запуск контейнера
docker-compose up -d
docker exec -i app bash -c "cd /data/brackets.local && composer install"
