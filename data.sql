INSERT INTO films (name) VALUES
    ('Крик'),
    ('Властелин колец'),
    ('Гарри Поттер'),
    ('Сумерки'),
    ('Хищник')
;

INSERT INTO attributes_types (name) VALUES
    ('целое число'),
    ('число с плавающей точкой'),
    ('булево'),
    ('текст'),
    ('дата')
;

INSERT INTO attributes (name, type_id) VALUES
    ('Дата начала продажи билетов', 5),
    ('Дата окончания продажи билетов', 5),
    ('16+', 3),
    ('Описание', 4),
    ('Просмотров', 1),
    ('Рейтинг', 2)
;

INSERT INTO films_values (value_integer,
                          value_text,
                          value_timestamp,
                          value_boolean,
                          value_float,
                          attribute_id,
                          film_id) VALUES
('12234223', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.', now(), True, '4.4', 1, 1),
('1223423', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.', now()+ interval '1 day', false, '6.4', 2, 2),
('12346342', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.', now()+ interval '20 day', false, '6.4', 3, 2),
;

