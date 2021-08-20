```
# cd hw12-testing

cp .env.example .env

# add record to /etc/hosts
sudo bash -c "echo \"192.168.42.2   application.local\" >> /etc/hosts"

docker-compose up -d

docker-compose exec app composer install
```
