### Install
```bash
cp .env.example .env

// confugure .env file

// add line '127.0.0.1 mysite.local' to hosts file

docker-compose up --build -d

docker exec -it app1 bash

cd mysite.local

composer install
```

### Example use

```bash
php index.php emails.txt
```