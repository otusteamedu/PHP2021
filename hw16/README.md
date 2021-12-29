#Запуск
docker-compose up -d
docker exec -it app bash
cd /data/redis.local/redis.test/
composer install
php artisan migrate:refresh --path=./database/migrations/2021_11_05_201901_create_requests_table.php
php artisan queue:work

#
http://redis.local/api/documentation