SELECT  
    SUM(p.amount) AS Profit,
    m.name AS Movie
FROM 
    bookings b
    INNER JOIN sessions s ON b.session_id = s.id
    INNER JOIN movies m ON s.movie_id = m.id
    INNER JOIN prices p ON p.session_id = s.id
GROUP BY m.name
ORDER BY 1 desc
LIMIT 1