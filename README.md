# PHP2021

### Launch local environment

Start application docker containers:
``` bash
docker-compose up -d
```

Install composer dependencies and start server and client:
```bash
docker exec -it $(docker ps | awk ' /otus_server/ { print $1 }') composer install
docker exec -it $(docker ps | awk ' /otus_server/ { print $1 }') php app.php server
docker exec -it $(docker ps | awk ' /otus_client/ { print $1 }') php app.php client
```