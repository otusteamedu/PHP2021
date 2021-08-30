# Дамашнее задание 6

## Схема БД

<a href="https://dbdiagram.io/embed/61276a1a6dc2bb6073bc71c2">dbdiagram.io</a>

## DDL скрипт

[Открыть](docker/postgres/init/ddl.sql)

## Проверка запроса на самый прибыльный фильм

1. Скопировать файл окружения
```shell
cp ./docker/.env.example ./docker/.env
```

2. Войти в папку проекта и выполнить docker-compose
```shell
docker-compose -f docker/docker-compose.yml up -d
```

3. Войти в контейнер postgres
```shell
docker-compose -f docker/docker-compose.yml exec --user=postgres postgres psql
```

4. Выполнить sql запрос
```sql
SELECT movies.name AS movie
FROM movies 
JOIN sessions ON movies.id=sessions.movie_id 
JOIN tickets ON sessions.id=tickets.session_id 
GROUP BY movies.id 
ORDER BY SUM(tickets.sell_price) DESC
LIMIT 1;
```