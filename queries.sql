-- Simple Queries

    -- Получение фильма "Мстители"
    SELECT id FROM films WHERE name = 'Мстители';

    -- Получение сеансов, которые стоят дешевле 300
    SELECT price FROM sessions WHERE price > 300 ORDER BY price;

    -- Получение названий фильмов с названием длиной в 8 символов
    SELECT name FROM films WHERE length(name) = 8;

-- Difficult Queries

    -- Партиционирование
    -- Получение сессий с суммарной ценой фильма за все сессии
    SELECT sessions.id, films.name, sum(price) OVER w
    FROM films JOIN sessions ON sessions.film_id = films.id
        WINDOW w AS (PARTITION BY film_id);

    -- индекс цены
    -- Получение залов, в которых сессии не дороже 300 рублей
    -- Частичный индекс
    SELECT halls.name FROM sessions
        JOIN hall_zones on sessions.hall_zone_id = hall_zones.id
        JOIN halls on halls.id = hall_zones.hall_id
        WHERE price < 300

    -- Получение кол-ва сессий, в которых показывают не фильм "Мстители"
    SELECT COUNT(sessions.id) FROM sessions
        JOIN films ON sessions.film_id = films.id
    WHERE films.name != 'Мстители'








