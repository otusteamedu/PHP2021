INSERT INTO halls (name) VALUES 
('hall_1'),
('hall_2'),
('hall_3')
;

INSERT INTO movies (name) VALUES 
('movie_1'),
('movie_2'),
('movie_3'),
('movie_4')
;

INSERT INTO clients (name) VALUES 
('client_1'),
('client_2'),
('client_3'),
('client_4')
;

INSERT INTO seats (hall_id, row, seat) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(1, 2, 1),
(1, 2, 2),
(1, 2, 3)
;

INSERT INTO sessions (time_start, time_end, hall_id, movie_id, price) VALUES
('1999-01-08 12:00:00', '1999-01-08 14:00:00', 1, 1, 250),
('1999-01-08 12:00:00', '1999-01-08 14:00:00', 2, 1, 250),
('1999-01-08 12:00:00', '1999-01-08 14:00:00', 3, 2, 150),
('1999-01-08 14:00:00', '1999-01-08 16:00:00', 1, 1, 150),
('1999-01-08 14:00:00', '1999-01-08 16:00:00', 2, 2, 250),
('1999-01-08 14:00:00', '1999-01-08 16:00:00', 3, 2, 150),
('1999-01-08 16:00:00', '1999-01-08 18:00:00', 1, 3, 250)
;

INSERT INTO tickets (seat_id, session_id, client_id) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 2),
(4, 1, 2),
(5, 1, 2),
(6, 1, 2),
(1, 5, 3),
(2, 5, 3),
(3, 5, 3),
(4, 5, 3),
(5, 5, 4),
(6, 5, 4)
;


SELECT movies.name AS movie 
FROM movies 
JOIN sessions ON movies.id=sessions.movie_id 
JOIN tickets ON sessions.id=tickets.session_id 
GROUP BY movies.id 
ORDER BY SUM(sessions.price) DESC 
LIMIT 1;

