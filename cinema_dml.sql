-- Поиск самого прибыльного фильма
WITH
    movie_profit_ranks AS (
        WITH
            session_profit AS (
                SELECT
                    ct.session_id,
                    SUM(cp.value) AS profit
                FROM
                    cinema_tickets AS ct
                        JOIN cinema_prices AS cp ON
                        cp.id = ct.price_id
                WHERE
                    ct.status = 1
                GROUP BY
                    ct.session_id)
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
