#!/bin/bash

sudo mv ../settings/.env_docker docker/.env
cd docker
docker-compose up -d nginx php-fpm
cd ../
sudo mv ../settings/.env .env
sudo composer install
sudo php artisan migrate
sudo php artisan db:seed

sudo mv ../settings/nginx.host.conf "/etc/nginx/sites-available/$1.conf" -f
sudo ln -s -f "/etc/nginx/sites-available/$1.conf" /etc/nginx/sites-enabled/test_project_enabled
service nginx restart
service php7.4-fpm restart

activeNginx=$(systemctl is-active nginx)
activePhp=$(systemctl is-active php7.4-fpm)
while [ "$activeNginx" != "active" ]
do
    activeNginx=$(systemctl is-active nginx);
done

while [ "$activePhp" != "active" ]
do
    activePhp=$(systemctl is-active activePhp);
done

cd docker
docker-compose down
cd ../

sudo php artisan queue:work > ./storage/logs/queue.log 2>&1 &
