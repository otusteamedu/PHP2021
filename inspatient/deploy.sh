sudo service nginx restart
sudo composer update
sudo composer install -q
sudo service php7.4-fpm restart
sudo -u www-data sed -i -- "s|%DATABASE_HOST%|$2|g" .env
sudo -u www-data sed -i -- "s|%DATABASE_USER%|$3|g" .env
sudo -u www-data sed -i -- "s|%DATABASE_PASSWORD%|$4|g" .env
sudo -u www-data sed -i -- "s|%DATABASE_NAME%|$5|g" .env
sudo -u www-data sed -i -- "s|%APP_URL%|$6|g" .env
sudo -u www-data sed -i -- "s|%RABBITMQ_HOST%|$7|g" .env
sudo -u www-data sed -i -- "s|%RABBITMQ_USER%|$8|g" .env
sudo -u www-data sed -i -- "s|%RABBITMQ_PASSWORD%|$9|g" .env
php artisan key:generate
php artisan migrate
#php artisan migrate:refresh --seed
php artisan orchid:admin test test@test.com 123qwe
#php artisan orchid:admin profox profox@profox.pro 123qwe
#php artisan storage:link