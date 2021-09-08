# Дамашнее задание 7

## DDL скрипт

[Открыть](docker/postgres/init/ddl.sql)

## Скрипты создания VIEW
[Service view](service_view.sql) <br>
[Management view](manager_view.sql)

## Проверка работы view

1. Скопировать файл окружения
```shell
cp .env.example .env
```

2. Запустить docker-compose
```shell
docker-compose up -d
```

3. Войти в контейнер postgres
```shell
docker-compose exec --user=postgres postgres psql
```

4. Выполнить sql запрос
```sql
//service
SELECT * FROM service;

//management
SELECT * FROM management;
```
