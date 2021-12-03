# Подготовка окружения
create-env:
	cp .env.example .env

# Работа с образами и контейнерами
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

# Дополнительные команды
bash-server:
	docker-compose exec backend-server bash
bash-client:
	docker-compose exec backend-client bash
start-server:
	docker-compose exec backend-server php app.php start-server
start-client:
	docker-compose exec backend-client php app.php start-client
