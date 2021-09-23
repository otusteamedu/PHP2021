```
cp code/.env.example code/.env

# git clone https://github.com/laradock/laradock.git <path-to-laradock>
# cp .env.example-laradock <path-to-laradock>/.env

# cd <path-to-laradock>
docker-compose up -d nginx postgres
docker-compose exec --user=laradock workspace composer install
docker-compose exec workspace php artisan migrate
```