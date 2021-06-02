
PROJECT_NAME=otus-hw5

.DEFAULT_GOAL := help

bootstrap: ## Initial build
	make build
	make start

pull: ## Run pull and migrations
	git status
	git pull

start:
	docker-compose -p $(PROJECT_NAME) -f docker/docker-compose.yml up -d

build:
	docker-compose -p $(PROJECT_NAME) -f docker/docker-compose.yml build

rebuild:
	docker-compose -p $(PROJECT_NAME) -f docker/docker-compose.yml build --no-cache --pull
	make stop
	make start

stop:
	docker-compose -p $(PROJECT_NAME) -f docker/docker-compose.yml stop

rm:
	docker-compose -p $(PROJECT_NAME) -f docker/docker-compose.yml rm -fsv

chown-user: ## Chown folder to current user
	sudo -E chown -R $$USER:$$USER ./

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) |  awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-16s\033[0m %s\n", $$1, $$2}'

