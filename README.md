# PHP2021

## Домашнее задание №1

### Развернуть инфраструктуру на базе Docker Compose

1. Создайте `.env` с помощью команды `cp .env.example .env` (или `make create-env`)
2. Отредактируйте `.env` как вам нужно. Можно задать имя хоста, логин и пароль к базе данных, а также порты к сервисам.
3. Разверните инфраструктуру с помощью команды `docker-compose up --remove-orphans -d` (или `make up`)
4. Убедитесь, что указанный в `.env` хост указан в `hosts` файле вашей ОС.
5. Откройте в браузере хост указанный в `.env` (обязательно указав протокол `http://{host}`)
6. Чтобы остановить контейнеры и удалить всю развёрнутую инфраструктуру используйте команду `docker-compose down --rmi local --remove-orphans --volumes` (или `make down`)
7. Отдельно удалите скачанные образы, те что не нужны: `docker rmi -f php:7.4-fpm nginx:alpine mysql:5.7.22 memcached:alpine redis:alpine` (или `make delete-base-images`)

### Развернуть инфраструктуру на базе Virtual Box - Vagrant - Homestead

![Результат работы](https://raw.githubusercontent.com/otusteamedu/PHP2021/ea838383ab907dba0aa4fd263814ba614cea2140/screenshots/homestead.png)