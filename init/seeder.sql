INSERT INTO halls (name) VALUES ('hall 1'), ('hall 2');

INSERT INTO session_types (name) VALUES ('morning'), ('evening');

INSERT INTO customers (name, phone, email) VALUES
    ('Jora1', '11111', 'em1@gmail.com'),
    ('Jora2', '11111', 'em2@gmail.com'),
    ('Jora3', '11111', 'em3@gmail.com'),
    ('Jora4', '11111', 'em4@gmail.com'),
    ('Jora5', '11111', 'em5@gmail.com');


INSERT INTO films (name, type, description, duration)
VALUES
       ('Star wars 1', 'comedy', 'description', 213),
       ('Star wars 2', 'comedy', 'description', 213);

INSERT INTO seats (hall_id, row, counts, type) VALUES
(1, 1, 5, 'single'),
(1, 2, 5, 'single'),
(1, 3, 5, 'single'),
(2, 1, 5, 'single'),
(2, 2, 5, 'single'),
(2, 3, 5, 'single');

INSERT INTO prices (film_id, seat_id, session_type_id, value) VALUES
(1, 1, 1, 100),
(1, 2, 1, 100),
(1, 3, 1, 100),
(2, 4, 2, 300),
(2, 5, 2, 300),
(2, 6, 2, 300);


INSERT INTO sessions (film_id, hall_id, session_type_id, start_date) VALUES
(1, 1, 1, '2021-01-01 10:00:00'),
(2, 2, 2, '2021-01-01 17:00:00');

INSERT INTO orders (number_order, customer_id, session_id, seat_number, status, price) VALUES
('number1', 1, 1, 3, 'bought', 100),
('number1', 1, 1, 4, 'bought', 100),
('number2', 2, 1, 5, 'bought', 100),
('number3', 3, 2, 6, 'bought', 300),
('number4', 4, 2, 8, 'bought', 300),
('number5', 5, 2, 7, 'bought', 300)
;

