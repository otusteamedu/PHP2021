-- Наполение таблицы кинозалов
INSERT INTO
    public.cinema_screens (id, "name", max_seats)
VALUES
    (0, 'standard', 250),
    (1, 'premium', 50),
    (2, 'imax', 350);

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

-- Наполение таблицы киносеансов (500 записей на каждый зал)
DO
$do$
    DECLARE
        start_time   timestamp;
        random_movie RECORD;
    BEGIN
        FOR screen_id IN 0..2
            LOOP
                start_time := '2022-02-01 08:00:00'::timestamp;
                FOR i IN 0..500
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
