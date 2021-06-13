INSERT INTO films (name, duration, release_date) VALUES
('film1', 120, '2021-06-07'),
('film2', 120, '2021-06-07'),
('film3', 120, '2021-06-07');

INSERT INTO attribute_types (name, code, description) VALUES
('Text', 'text', 'Текстовое значение'),
('Service dates', 'service_date', 'Служебные даты'),
('Regular dates', 'regular_date', 'Обычные даты'),
('Numeric', 'num', 'Денежные значения'),
('Integer', 'int', 'Числовые значения'),
('Boolean', 'bool', 'Да/Нет');

INSERT INTO attributes (name, code, attribute_type_id) VALUES
('Рецензии', 'reviews', 1),
('Есть премия', 'have_reward', 6),
('Мировая премьера', 'world_premiere', 3),
('Премьера в РФ', 'russia_premiere', 3),
('Дата начала продажи билетов', 'start_sale', 2),
('Дата запуска рекламы на ТВ', 'start_ads', 2);

INSERT INTO attribute_values (attribute_id, film_id, value_text) VALUES
(1, 1, 'Тестовая рецензия 1'),
(1, 1, 'Тестовая рецензия 2'),
(1, 1, 'Тестовая рецензия 3'),
(1, 2, 'Тестовая рецензия 4'),
(1, 2, 'Тестовая рецензия 5');

INSERT INTO attribute_values (attribute_id, film_id, value_bool) VALUES
(2, 1, true),
(2, 2, false),
(2, 3, true);

INSERT INTO attribute_values (attribute_id, film_id, value_date) VALUES
(5, 1, current_date),
(6, 1, current_date-5),
(5, 2, current_date+20),
(6, 2, current_date),
(5, 3, current_date+20),
(6, 3, current_date),
(3, 1, current_date-1),
(4, 1, current_date),
(3, 2, current_date+19),
(4, 2, current_date+20),
(3, 3, current_date+19),
(4, 3, current_date+20);
