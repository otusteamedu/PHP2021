```
# cd hw-1-environment/docker-environment

cp .env.example .env

# add record to /etc/hosts
sudo bash -c "echo \"192.168.40.2   application.local\" >> /etc/hosts"

docker-compose up -d

docker-compose exec app bash

# >>
composer install
```
