# PHP2021

### Launch local environment
Create .env file:
``` bash
cp .env.example .env
```

Start application docker containers:
``` bash
docker-compose up -d
```

Install composer dependencies and start server and client:
```bash
docker exec -it $(docker ps | awk ' /app1/ { print $1 }') bash
cd mysite.local/ && composer install
```