# PHP2021

## Схема БД
<a href="https://dbdiagram.io/embed/61951b5e02cf5d186b5b2e82">dbdiagram.io</a>

## Проверка запроса на самый прибыльный фильм

1. cp .env.example .env
2. docker-compose up -d
3. docker exec -it pg_cinema psql -U postgres
4. Выполнить запрос 
SELECT films.name FROM films
    JOIN sessions ON films.id=sessions.film_id
    JOIN orders ON sessions.id=orders.session_id
GROUP BY films.id
ORDER BY SUM(orders.price) DESC
LIMIT 1;
