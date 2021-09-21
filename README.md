#Установка на тест

##hosts.example
Добавить содержимое в C:\Windows\System32\drivers\etc\hosts (Windows) или /etc/hosts (Linux)

##docker-compose.yml.example
Изменить, если нужно конфиги, переименовать в docker-compose.yml

##code/search-app/.env.example
Изменить параметры окружения, переименовать в .env

##Сборка/Запуск контейнеров
docker-compose up -d
docker exec -it app bash (winpty docker exec -it app bash - для windows)
cd /data/youtube.local/search-app/
php artisan migrate --seed

##Тестирование функционала
Заходим на http://youtube.local/ через браузер/тестируем.
