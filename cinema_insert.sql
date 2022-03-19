-- Наполение таблицы кинозалов
INSERT INTO
    public.cinema_screens (id, "name", max_seats)
VALUES
    (0, 'standard', 250),
    (1, 'premium', 50),
    (2, 'imax', 350);

-- Наполение таблицы мест в кинотеатре (зал standard)
DO
$do$
    BEGIN
        FOR row_id IN 1..5
            LOOP
                FOR place_id IN 1..5
                    LOOP
                        INSERT
                        INTO
                            public.cinema_seats (screen_id, "row", place)
                        VALUES (0, row_id, place_id);
                    END LOOP;
            END LOOP;
    END;
$do$;

-- Наполение таблицы мест в кинотеатре (зал premium)
DO
$do$
    BEGIN
        FOR row_id IN 1..2
            LOOP
                FOR place_id IN 1..3
                    LOOP
                        INSERT
                        INTO
                            public.cinema_seats (screen_id, "row", place)
                        VALUES (1, row_id, place_id);
                    END LOOP;
            END LOOP;
    END;
$do$;

-- Наполение таблицы мест в кинотеатре (зал imax)
DO
$do$
    BEGIN
        FOR row_id IN 1..5
            LOOP
                FOR place_id IN 1..7
                    LOOP
                        INSERT
                        INTO
                            public.cinema_seats (screen_id, "row", place)
                        VALUES (2, row_id, place_id);
                    END LOOP;
            END LOOP;
    END;
$do$;

-- Наполение таблицы фильмов
INSERT INTO
    public.cinema_movies (name_original, name_loc, duration_min)
VALUES
    ('Back to the Future', 'Назад в будущее', 115),
    ('Back to the Future 2', 'Назад в будущее 2', 110),
    ('Back to the Future 3', 'Назад в будущее 3', 120),
    ('Godfather', 'Крестный отец', 175),
    ('Home Alone', 'Один дома', 100),
    ('Home Alone 2', 'Один дома 2', 120);

-- Наполение таблицы киносеансов (250 записей на каждый зал)
DO
$do$
    DECLARE
        start_time   timestamp;
        random_movie RECORD;
    BEGIN
        FOR screen_id IN 0..2
            LOOP
                start_time := '2022-02-01 08:00:00'::timestamp;
                FOR i IN 0..250
                    LOOP
                        SELECT
                            id,
                            duration_min
                        FROM
                            cinema_movies
                        OFFSET floor(random() *
                                     (SELECT COUNT(*) FROM cinema_movies)) LIMIT 1
                        INTO random_movie;
                        INSERT
                        INTO
                            public.cinema_sessions (movie_id, screen_id, session_start)
                        VALUES (random_movie.id, screen_id, start_time);
                        start_time = start_time +
                                     ceil((random_movie.duration_min + 20) / 5) *
                                     '5 minutes'::interval;
                        IF date_part('hour', start_time) > 21 THEN
                            start_time = start_time::date +
                                         '1 day 08:00:00'::interval;
                        END IF;
                    END LOOP;
            END LOOP;
    END;
$do$;

-- Наполение таблицы цен на билеты
INSERT INTO
    public.cinema_prices (id, "name", value)
VALUES
    (0, 'standart_daily', 250),
    (1, 'standart_weekend', 350),
    (100, 'premium_daily', 600),
    (101, 'premium_weekend', 700),
    (200, 'imax_daily', 450),
    (201, 'imax_weekend', 550);

-- Наполение таблиц билетов
INSERT INTO
    cinema_tickets (session_id, seat_id, price, status)
SELECT
    csess.id        AS session_id,
    cseat.id        AS seat_id,
    CASE
        WHEN csess2.screen_id = 0 AND
             extract(ISODOW FROM csess2.session_start) NOT IN (6, 7) THEN 250
        WHEN csess2.screen_id = 0 AND
             extract(ISODOW FROM csess2.session_start) IN (6, 7) THEN 350
        WHEN csess2.screen_id = 1 AND
             extract(ISODOW FROM csess2.session_start) NOT IN (6, 7) THEN 600
        WHEN csess2.screen_id = 1 AND
             extract(ISODOW FROM csess2.session_start) IN (6, 7) THEN 700
        WHEN csess2.screen_id = 2 AND
             extract(ISODOW FROM csess2.session_start) NOT IN (6, 7) THEN 450
        WHEN csess2.screen_id = 2 AND
             extract(ISODOW FROM csess2.session_start) IN (6, 7) THEN 550
        ELSE 0
        END         AS price,
    round(random()) AS status
FROM
    cinema_sessions AS csess
        JOIN cinema_seats AS cseat ON cseat.screen_id = csess.screen_id
        JOIN cinema_sessions AS csess2 ON csess2.id = csess.id
ORDER BY
    csess.id
LIMIT 10000;
