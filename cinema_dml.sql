-- Поиск самого прибыльного фильма
WITH
    movie_profit_ranks AS (
        WITH
            session_profit AS (
                SELECT
                    session_id,
                    SUM(price) AS profit
                from
                    cinema_tickets
                GROUP BY
                    session_id, status
                HAVING
                    status = 1)
        SELECT
            cs.movie_id,
            cm.name_original AS movie_name,
            rank() OVER (ORDER BY SUM(profit) desc) AS rnk
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
