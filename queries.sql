-- Simple Queries

SELECT id FROM films WHERE name != 'Мстители';

SELECT id FROM sessions WHERE price < 300 ORDER BY price;

SELECT id FROM seats WHERE row = 4;

-- Difficult Queries

SELECT films.name, sum(price) OVER w
FROM sessions JOIN films ON sessions.film_id = films.id
    WINDOW w AS (PARTITION BY film_id);

SELECT seats.row, seats.seat, hall_zones.name as hall_zone_name FROM seats
    LEFT JOIN buyed_tickets ON seats.id = seat_id
    JOIN hall_zones ON seats.hall_zone_id = hall_zones.id
    WHERE seat_id IS NULL;

SELECT session_id, sum(actual_price) FROM buyed_tickets GROUP BY session_id;



