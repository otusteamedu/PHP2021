DELETE FROM attribute_value;
DELETE FROM attribute;
DELETE FROM attribute_type;
DELETE FROM movie;


INSERT INTO movie (id, name) VALUES
(1, 'Матрица'),
(2, 'Терминатор'),
(3, 'Форсаж'),
(4, 'Звездные войны'),
(5, 'Чужой')
;

SELECT setval('movie_id_seq', max(id)) FROM movie;


INSERT INTO attribute_type (id, name) VALUES
(1, 'целое число'),
(2, 'число'),
(3, 'булево'),
(4, 'текст'),
(5, 'дата')
;

SELECT setval('attribute_type_id_seq', max(id)) FROM attribute_type;


INSERT INTO attribute (id, name, attribute_type_id) VALUES
(1, 'Дата начала продажи билетов', 5),
(2, 'Дата начала запуска рекламы по ТВ', 5),
(3, 'Дата окончания продажи билетов', 5),
(4, 'Дата окончания показа рекламы по ТВ', 5),
(5, 'Оскар', 3),
(6, 'Описание', 4),
(7, 'Частей', 1),
(8, 'Сборы', 2)
;

SELECT setval('attribute_id_seq', max(id)) FROM attribute;


INSERT INTO attribute_value (id, value_int, value_text, value_date, value_bool, value_num, attribute_id, movie_id) VALUES
(1, NULL, NULL, now(), NULL, NULL, 1, 1),
(2, NULL, NULL, now() + interval '1 day', NULL, NULL, 2, 1),
(3, NULL, NULL, now(), NULL, NULL, 3, 1),
(4, NULL, NULL, now() + interval '20 day', NULL, NULL, 4, 1),
(5, NULL, NULL, NULL, true, NULL, 5, 2),
(6, NULL, NULL, NULL, false, NULL, 5, 3),
(7, NULL, 'ghghghghhghghg', NULL, NULL, NULL, 6, 2),
(8, 3, NULL, NULL, NULL, NULL, 7, 4),
(9, NULL, NULL, NULL, NULL, 5000000.00, 8, 1)
;

SELECT setval('attribute_value_id_seq', max(id)) FROM attribute_value;
