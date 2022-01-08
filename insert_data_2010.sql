-- добавление залов
INSERT INTO halls (name, num_rows, num_seats, num_section, price_ratio) VALUES ('VIP зал №1', 5, 25, 5, 1.5);
INSERT INTO halls (name, num_rows, num_seats, num_section, price_ratio) VALUES ('VIP зал №2', 5, 25, 5, 1.5);
INSERT INTO halls (name, num_rows, num_seats, num_section, price_ratio) VALUES ('Малый красный зал', 10, 100, 5, 1.3);
INSERT INTO halls (name, num_rows, num_seats, num_section, price_ratio) VALUES ('Малый синий зал', 10, 100, 5, 1.3);
INSERT INTO halls (name, num_rows, num_seats, num_section, price_ratio) VALUES ('Малый зеленый зал', 10, 100, 5, 1.3);
INSERT INTO halls (name, num_rows, num_seats, num_section, price_ratio) VALUES ('Средний красный зал', 16, 320, 4, 1.1);
INSERT INTO halls (name, num_rows, num_seats, num_section, price_ratio) VALUES ('Средний синий зал', 16, 320, 4, 1.1);
INSERT INTO halls (name, num_rows, num_seats, num_section, price_ratio) VALUES ('Средний зеленый зал', 16, 320, 4, 1.1);
INSERT INTO halls (name, num_rows, num_seats, num_section, price_ratio) VALUES ('Большой красный зал', 20, 400, 5, 1.0);
INSERT INTO halls (name, num_rows, num_seats, num_section, price_ratio) VALUES ('Большой синий зал', 20, 400, 5, 1.0);

-- добавеление фильмов
insert into films ("id", "name")
select gs.id,
       generate_suggestion(1,10)
from generate_series(1,10000) as gs(id);

-- формирование стоимости показа фильмов
select insert_price();

-- добавление сеансов за один год
select insert_sessions_2010();

-- добавление информации о продаже билетов за один год
select insert_sales_2010();