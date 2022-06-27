#!/bin/bash

sudo mv ../settings/.env docker/.env
cd docker
docker-compose up -d nginx php-fpm
cd ../
sudo mv ../settings/.env .env
sudo composer install

sudo mv ../settings/nginx.host.conf "/etc/nginx/sites-available/$1.conf" -f
sudo ln -s -f "/etc/nginx/sites-available/$1.conf" /etc/nginx/sites-enabled/otus_local
systemctl restart nginx
systemctl restart php:8.0-fpm

isActiveNginx=$(systemctl is-active nginx)
isActivePhp=$(systemctl is-active php:8.0-fpm)
while [ "$isActiveNginx" != "active" ]
do
    isActiveNginx=$(systemctl is-active nginx);
done

while [ "$isActivePhp" != "active" ]
do
    isActivePhp=$(systemctl is-active activePhp);
done

cd docker
docker-compose down
cd ../
