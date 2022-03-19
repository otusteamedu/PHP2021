#!/bin/bash

IMAGE=${1};
APP_ACCESS_TOKEN=${2};
DB_URL=${3};
REDIS_URL=${4};
REMOTE_FS=${5};

APP_NAME="tv-backend-tasks"
APP_NAME_CLUSTER="${APP_NAME}-cluster"

if [[ "$(docker service ls -q -f name=$APP_NAME_CLUSTER)" ]]
then
    echo "Update service"
    docker service update \
        --env-add APP_ENV=prod \
        --env-add API_ACCESS_TOKEN="$APP_ACCESS_TOKEN" \
        --env-add DATABASE_URL="$DB_URL" \
        --env-add REDIS_URL="$REDIS_URL" \
        --env-add REMOTE_FS="$REMOTE_FS" \
        -d \
        --with-registry-auth \
        --image "$IMAGE" \
        $APP_NAME_CLUSTER;
else
    echo "Create service"
    docker service create \
        -e APP_ENV=prod \
        -e API_ACCESS_TOKEN="$APP_ACCESS_TOKEN" \
        -e DATABASE_URL="$DB_URL" \
        -e REDIS_URL="$REDIS_URL" \
        -e REMOTE_FS="$REMOTE_FS" \
        -p 8150:80 \
        -d \
        --replicas 2 \
        --update-delay 10s \
        --with-registry-auth \
        --name $APP_NAME_CLUSTER \
        "$IMAGE";
fi
