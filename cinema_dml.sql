-- Простой запрос 1 - Поиск сеансов фильма по фильтру с id = 10 (Godfather) в зале с id = 1 (premium)
SELECT *
FROM
    cinema_sessions
WHERE
      movie_id = 10
  AND screen_id = 1;

-- Простой запрос 2 - Определение прибыльности каждого сеанса
SELECT
    session_id,
    sum(price) AS profit
FROM
    cinema_tickets
WHERE
    status = 1
GROUP BY
    session_id;

-- Простой запрос 3 - Определение количества еще не проданных на каждый сеанс билетов
SELECT
    session_id,
    count(*) as not_sold_tickets
FROM
    cinema_tickets
WHERE
    status = 0
GROUP BY
    session_id
ORDER BY
    session_id;

-- Сложный запрос 1 - Общее время показа каждого фильма
SELECT
    cm.name_original,
    cm.duration_min * count(*) AS total_time
FROM
    cinema_sessions AS cs
        JOIN cinema_movies AS cm ON cs.movie_id = cm.id
GROUP BY
    cm.name_original,
    cm.duration_min
ORDER BY
    total_time DESC;

-- Сложный запрос 2 - Самый заполняемый ряд в кинозале standard
SELECT
    cs."row",
    count(cs."row") AS tickets_sold
FROM
    cinema_tickets AS ct
        JOIN cinema_seats AS cs ON ct.seat_id = cs.id
WHERE
      ct.status = 1
  AND cs.screen_id = 0
GROUP BY
    cs."row"
ORDER BY
    tickets_sold DESC
LIMIT 1;

-- Сложный запрос 3 - Самый прибыльный фильм
WITH
    movie_profit_ranks AS (
        WITH
            session_profit AS (
                SELECT
                    session_id,
                    sum(price) AS profit
                FROM
                    cinema_tickets
                WHERE
                    status = 1
                GROUP BY
                    session_id)
        SELECT
            cs.movie_id,
            cm.name_original                           AS movie_name,
            sum(sp.profit)                             AS movie_profit,
            rank() OVER (ORDER BY SUM(sp.profit) desc) AS rnk
        FROM
            cinema_sessions AS cs
                JOIN session_profit AS sp ON sp.session_id = cs.id
                JOIN cinema_movies AS cm ON cm.id = cs.movie_id
        GROUP BY
            cs.movie_id,
            cm.name_original
    )
SELECT
    movie_name,
    movie_profit
FROM
    movie_profit_ranks
WHERE
    rnk = 1;
