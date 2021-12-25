-- Поиск самого прибыльного фильма
WITH
    movie_profit_ranks AS (
        SELECT
            cm.name_original AS movie_name,
            rank() OVER (ORDER BY SUM(cs.ticket_price*cs.sold_seats) DESC) AS rnk
        FROM
            cinema_sessions AS cs
                JOIN cinema_movies AS cm ON
                cm.id = cs.movie_id
        GROUP BY
            cs.movie_id,
            cm.name_original)
SELECT
    movie_name
FROM
    movie_profit_ranks
WHERE
    rnk = 1;
