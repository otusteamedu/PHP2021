create-env:
	cp .env.example .env
up:
	docker-compose up --remove-orphans -d
down:
	docker-compose down --rmi local --remove-orphans --volumes
start:
	docker-compose start
stop:
	docker-compose stop
delete-base-images:
	docker rmi -f php:7.4-fpm nginx:alpine mysql:5.7.22 memcached:alpine redis:alpine

bash-webserver:
	docker-compose exec webserver sh
