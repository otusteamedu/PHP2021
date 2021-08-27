SELECT movies.name AS movie 
FROM movies 
JOIN sessions ON movies.id=sessions.movie_id 
JOIN tickets ON sessions.id=tickets.session_id 
GROUP BY movies.id 
ORDER BY SUM(sessions.price) DESC 
LIMIT 1;