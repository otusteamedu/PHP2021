-- Simple Queries

SELECT id FROM films WHERE name != 'Мстители';

SELECT id FROM sessions WHERE price < 300 ORDER BY price;

SELECT time FROM sessions WHERE price > 300;
-- SELECT id FROM seats WHERE row = 4; Поменять

-- Difficult Queries

-- функциональный индекс
SELECT films.name, sum(price) OVER w
FROM sessions JOIN films ON sessions.film_id = films.id
    WINDOW w AS (PARTITION BY film_id);

-- индекс цены
SELECT halls.name FROM sessions
    JOIN hall_zones on sessions.hall_zone_id = hall_zones.id
    JOIN halls on halls.id = hall_zones.hall_id
    WHERE price < 300

-- Составной индекс
SELECT sessions.id, price FROM sessions
    JOIN films ON sessions.film_id = films.id
    WHERE films.name != 'Мстители'








