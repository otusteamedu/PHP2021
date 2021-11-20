# Вывод самого прибыльного фильма
SELECT film_id, name, sum
FROM (
	SELECT cinema_session.film_id, film.name, SUM(price) AS sum
	FROM tickets
		LEFT JOIN cinema_session ON tickets.session_id = cinema_session.id 
		LEFT JOIN film ON film_id = film.id
	GROUP BY film_id
	ORDER BY sum DESC
) AS film_sum
LIMIT 1