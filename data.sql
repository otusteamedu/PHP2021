INSERT INTO `cinema`.`movies`
(`name`,
`duration`)
VALUES
('Film 1', '1:30'),
('Film 2', '1:20'),
('Film 3', '1:10'),
('Film 4', '1:14'),
('Film 5', '1:35'),
('Film 6', '1:30'),
('Film 7', '1:31'),
('Film 8', '1:32'),
('Film 9', '1:33'),
('Film 10', '1:34');

INSERT INTO `cinema`.`halls`
(`name`,
`num_rows`,
`chairs_in_row`)
VALUES
('Red', 20, 30),
('Green', 25, 30),
('Blue', 15, 15),
('Yellow', 30, 40);

INSERT INTO `cinema`.`sessions`
(`movie_id`,
`hall_id`,
`time_start`)
VALUES
(1, 2, '2021-08-23 18:00:00'),
(2, 1, '2021-08-23 18:00:00'),
(5, 3, '2021-08-23 18:00:00'),
(1, 1, '2021-08-23 22:00:00');

INSERT INTO `cinema`.`tickets`
(`session_id`,
`n_row`,
`chair`,
`cost`)
VALUES
(1, 1, 1, 300),
(1, 1, 2, 300),
(1, 1, 3, 300),
(1, 1, 4, 300),
(1, 1, 5, 300),
(2, 1, 1, 300),
(2, 1, 2, 300),
(2, 1, 3, 300),
(2, 1, 4, 300),
(3, 1, 5, 300),
(4, 15, 10, 300),
(4, 15, 11, 300),
(4, 15, 11, 250);

INSERT INTO `cinema`.`order_ticket`
(`order_id`,
`ticket_id`)
VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(3, 10),
(4, 11),
(4, 12),
(4, 13);