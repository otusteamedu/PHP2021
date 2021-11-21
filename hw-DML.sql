# Вывод самого прибыльного фильма
SELECT id, name, film_sum
FROM (
	SELECT film.id, film.name, SUM(tickets.total_price) AS film_sum
	FROM tickets
		LEFT JOIN cinema_session ON tickets.session_id = cinema_session.id 
		LEFT JOIN film ON film_id = film.id
	GROUP BY film.id
	ORDER BY film_sum DESC
) AS res
LIMIT 1;