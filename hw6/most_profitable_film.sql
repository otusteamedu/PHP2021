SELECT 
	movies.name
FROM 
	movies
JOIN 
	sessions ON sessions.id_movie=movies.id
JOIN 
	tickets ON sessions.id=tickets.id_sessions
GROUP BY 
	movies.id
ORDER BY 
	SUM(tickets.final_price) 
DESC
LIMIT 1;