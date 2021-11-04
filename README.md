### server
```bash
docker-compose up --build -d
docker exec -it app-server bash
composer install
php app.php server
```

### client
```bash
docker exec -it app-client bash
php app.php client
```
