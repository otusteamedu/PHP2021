```
# cd hw6-design-database

docker-compose up -d
docker-compose exec db bash

su postgres
psql -h localhost -p 5432 -U docker -d docker
```