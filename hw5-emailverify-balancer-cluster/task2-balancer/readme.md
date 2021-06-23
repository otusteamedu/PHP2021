```
# cd hw5-emailverify-balancer-cluster/task2-balancer

cp .env.example .env
cp app1/.env.example app1/.env

docker-compose up -d

docker-compose exec app1-unix-socket composer install

cp -r app1 app2
```

#test
```
sudo bash -c "echo \"192.168.11.2 hw5.balancer.docker\" >> /etc/hosts"
while sleep 0.5; do curl -k https://hw5.balancer.docker; done
```
