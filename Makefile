init: down build up

build: docker-build
up: docker-up
down: docker-down
restart: down up

docker-up: ## Запуск контейнеров в режиме демонов
	docker-compose up -d

docker-down: ## Остановка контейнеров с удалением временных файлов
	docker-compose down --remove-orphans

docker-build: ## Сборка образов
	docker-compose build

ds-server: ## Войти в контейнер app-server c root правами
	docker-compose exec -u root app-server /bin/bash

ds-client: ## Войти в контейнер app-client c root правами
	docker-compose exec -u root app-client /bin/bash

server-start:
	docker-compose exec -u root app-server php index.php server

client-start:
	docker-compose exec -u root app-client php index.php client

mysql-down: ## Останавливаем mysql на хосте, если запущена
	sudo service mysql stop

env: ## копируем env.example
	cp .env.example .env

composer: ## выполнить composer install
	composer install

help: ## Парсит сам себя и выводит форматированный список всех комманд
	@grep -E '(^[a-z].*[^:]\s*##)|(^##)' Makefile | \
	perl -pe "s/^##\s*//" | \
	awk ' \
		BEGIN { FS = ":.*##" } \
		$$2 { printf "\033[32m%-30s\033[0m %s\n", $$1, $$2 } \
		!$$2 { printf " \033[33m%-30s\033[0m\n", $$1 } \
	'
