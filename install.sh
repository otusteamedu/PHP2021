#!/bin/bash

FILE=installed
DO_RESTART=restart

if test -f "$FILE"; then
    echo "Already installed"
else
    sudo pwd
    sudo mv ../settings/.env .env
    sudo composer install
    sudo php artisan migrate
    sudo php artisan db:seed

    echo "$1"

    sudo rm -rf /var/www/test_project/htdocs
    sudo ln -s "$(pwd)" /var/www/test_project/htdocs -f

    if test -f "$DO_RESTART"; then
        sudo mv ../settings/nginx.host.conf "/etc/nginx/sites-available/$1.conf" -f
        sudo ln -s -f "/etc/nginx/sites-available/$1.conf" /etc/nginx/sites-enabled/test_project_enabled
        sudo service nginx stop
        sudo service php8.0-fpm restart
        sudo systemctl restart rabbitmq-server
        sudo service nginx start
    fi

    sudo killall -9 php
    sudo php artisan queue:work > ./storage/logs/queue.log 2>&1 &

    sudo touch "$FILE"

fi
