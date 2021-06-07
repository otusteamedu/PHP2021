SELECT SUM(p.price * (100 - t.discount) / 100)
FROM ticket t
JOIN seat s ON s.id = t.seat_id
JOIN session se ON se.id = t.session_id
JOIN price p ON p.session_id = t.session_id AND p.zone_id = s.zone_id
GROUP BY se.film_id
ORDER BY SUM(price * (100 - t.discount) / 100) DESC
LIMIT 1
