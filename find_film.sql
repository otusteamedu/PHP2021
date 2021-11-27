SELECT f.name, SUM(t.cost) AS totalCost
FROM films f
         LEFT JOIN sessions s ON s.film_id = f.id
         LEFT JOIN tickets t ON t.session_id = s.id
WHERE t.status = 'CONFIRM'
GROUP BY f.id
ORDER BY totalCost DESC
LIMIT 1;