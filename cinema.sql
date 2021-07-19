SELECT 
	Films.Name
	sum(Booking.Price) as price
FROM Booking

JOIN Schedule ON Booking.ScheduleID = Schedule.id
JOIN Films ON Schedule.IDFilm = Films.FilmName
JOIN Places ON Booking.IDPlace = Places.id

GROUP BY Films.id
ORDER BY price DESC
LIMIT 1;