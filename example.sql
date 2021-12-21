--  Пример заполнения таблицы

INSERT INTO halls (name) VALUES ('Red'), ('Green');

INSERT INTO seats (halls_id, row, seat) VALUES
    (1, 1, 1),
    (1, 1, 2),
    (1, 1, 3),
    (1, 1, 4),
    (1, 1, 5),
    (1, 2, 1),
    (1, 2, 2),
    (1, 2, 3),
    (2, 1, 1),
    (2, 1, 2),
    (2, 2, 1),
    (2, 2, 2),
    (2, 3, 1),
    (2, 3, 2);

INSERT INTO films (name, price, duration) VALUES
    ('Звонок', 200.00, 2),
    ('Вой', 150.00, 2);

INSERT INTO session (hall_id, films_id, start_time) VALUES
(1, 1, '8:00'),
(1, 2, '10:00'),
(2, 1, '10:00'),
(2, 2, '14:00');

INSERT INTO users (name) VALUES ('Иван'), ('Петр'), ('Семен');

INSERT INTO tickets (user_id, seat_id, session_id, total_price) VALUES
    (1, 1, 1, 200.00),
    (2, 2, 1, 200.00),
    (3, 4, 1, 200.00);

INSERT  INTO busy_seats (seat_id, session_id) VALUES
    (1,1),
    (2,1),
    (4,1);

-- Пример запроса на наличие свободных мест на конкретный сеанс

SELECT seats.id, seats.row, seats.seat FROM seats WHERE seats.id NOT IN
    (SELECT seats_id FROM busy_seats, session where busy_seats.session_id = 2)
    and halls_id =1;

-- Пример запроса получения информации о билете

SELECT users.name ,tickets.total_price, seats.row, seats.seat, cinema.name, session.start_time
FROM tickets, seats, cinema, session, users
WHERE users.id = tickets.user_id AND  seats.id = tickets.seat_id AND session.id = tickets.session_id
  AND cinema.id = session.id;
