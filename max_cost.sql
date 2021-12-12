SELECT  films.name, total
FROM (
	SELECT films.id, films.name, SUM(tickets.total_price) AS total
	FROM tickets
		LEFT JOIN session ON tickets.session_id = session.id 
		LEFT JOIN films ON films_id = films.id
	GROUP BY films.id
	ORDER BY total DESC
) AS res
LIMIT 1;