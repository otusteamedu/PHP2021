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

INSERT INTO clients (name, discount) VALUES 
('client_1', 0),
('client_2', 10),
('client_3', 10),
('client_4', 15)
;

INSERT INTO seat_groups (name, price_multiplier) VALUES
('normal', 1),
('VIP', 1.2),
('free', 0)
;

INSERT INTO seats (hall_id, seat_group_id, row, seat) VALUES
(1, 1, 1, 1),
(1, 2, 1, 2),
(1, 3, 1, 3),
(1, 1, 2, 1),
(1, 2, 2, 2),
(1, 3, 2, 3)
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

INSERT INTO tickets (seat_id, session_id, client_id, sell_price) VALUES
(1, 1, 1, 300),
(2, 1, 1, 500),
(3, 1, 2, 0),
(4, 1, 2, 150),
(5, 1, 2, 150 ),
(6, 1, 2, 0),
(1, 5, 3, 200),
(2, 5, 3, 600),
(3, 5, 3, 0),
(4, 5, 3, 400),
(5, 5, 4, 400),
(6, 5, 4, 0)
;


SELECT movies.name AS movie
FROM movies 
JOIN sessions ON movies.id=sessions.movie_id 
JOIN tickets ON sessions.id=tickets.session_id 
GROUP BY movies.id 
ORDER BY SUM(tickets.sell_price) DESC
LIMIT 1;

