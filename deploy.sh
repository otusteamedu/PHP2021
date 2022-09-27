#!/bin/bash

if [["$(docker service ls -q -f name=${2})"]]
then
  echo 'update'
  sudo composer update
  docker service update \
    --env-add APP_ENV=prod -d --with-registry-auth \
    "${2}";
else
  echo 'create'
  sudo mv ../settings/nginx.host.conf "/etc/nginx/sites/available/$1.conf" -f
  sudo ln -s -f "/etc/nginx/sites/available/$1.conf" /etc/nginx/sites-enabled/otus.loc
  sudo mv ../settinngs/.env .env
  sudo composer install
  docker service create \
    --env APP_ENV=prod -d --with-registry-auth \
    -p 5001:80 --replicas 3 \
    "${2}";
fi