init: down build up composer

build: docker-build
re-build: down build up
up: docker-up
down: docker-down
restart: down up

docker-up: ## Запуск контейнеров в режиме демонов
	docker-compose up -d

docker-down: ## Остановка контейнеров с удалением временных файлов
	docker-compose down --remove-orphans

docker-build: ## Сборка образов
	docker-compose build

ds: ## Войти в контейнер php-fpm c root правами
	docker-compose exec -u root php-fpm /bin/bash

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
