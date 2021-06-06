SELECT
	films.id,
	films.name,
	count(sessions.id),
	sum(prices.price) as price
FROM tickets
JOIN sessions ON tickets.session_id = sessions.id
JOIN halls_sectors_places ON tickets.hall_sector_place_id = halls_sectors_places.id
JOIN halls_sectors ON halls_sectors_places.hall_sector_id = halls_sectors.id
JOIN prices ON sessions.id = prices.session_id AND halls_sectors.id = prices.hall_sector_id
JOIN films ON sessions.film_id = films.id
GROUP BY films.id
ORDER BY price DESC
LIMIT 1;