-- Пример заполнения строки справочника цен
INSERT INTO
    cinema_prices (id, "name", value)
VALUES
    (1, 'ticket price sample 1', 100);

-- Пример заполнения строки таблицы билетов
INSERT INTO
    cinema_tickets (session_id, seat_id, price, status)
VALUES
    (1, 1, (select value from cinema_prices where id = 1), 0);

-- Поиск самого прибыльного фильма
WITH
    movie_profit_ranks AS (
        WITH
            session_profit AS (
                SELECT
                    session_id,
                    SUM(price) AS profit
                FROM
                    cinema_tickets
                WHERE
                    status = 1
                GROUP BY
                    session_id)
        SELECT
            cs.movie_id,
            cm.name_original                           AS movie_name,
            rank() OVER (ORDER BY SUM(sp.profit) desc) AS rnk
        FROM
            cinema_sessions AS cs
                JOIN session_profit AS sp ON
                sp.session_id = cs.id
                JOIN cinema_movies AS cm ON
                cm.id = cs.movie_id
        GROUP BY
            cs.movie_id,
            cm.name_original
    )
SELECT
    movie_name
FROM
    movie_profit_ranks
WHERE
    rnk = 1;
