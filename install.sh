#!/bin/bash

sudo mv ../settings/.env .env
sudo composer install
sudo php artisan migrate
sudo php artisan db:seed

sudo mv ../settings/nginx.host.conf "/etc/nginx/sites-available/$1.conf" -f
sudo ln -s -f "/etc/nginx/sites-available/$1.conf" /etc/nginx/sites-enabled/test_project_enabled
sudo service nginx restart
sudo service php7.4-fpm restart

sudo php artisan queue:work > ./storage/logs/queue.log 2>&1 &
