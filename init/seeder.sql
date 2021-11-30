INSERT INTO film_attribute_types (name) VALUES
    ('varchar'),
    ('int'),
    ('timestamp');

INSERT INTO film_attributes (name, film_attribute_type_id) VALUES
    ('description', 1),
    ('budget', 2),
    ('start', 3),
    ('finish', 3);

INSERT INTO films (name)
VALUES ('Star wars 1'), ('Star wars 2');

INSERT INTO film_attribute_values (film_id, film_attribute_id, string_value, int_value, date_value) VALUES
    (1, 1, 'Description text films 1', null, null),
    (1, 2, null, 10000, null),
    (1, 3, null, null, '2021-11-27'),
    (1, 4, null, null, '2021-12-17'),
    (2, 1, 'Description text films 2', null, null),
    (2, 2, null, 30000, null),
    (2, 3, null, null, '2021-11-27'),
    (2, 4, null, null, '2021-12-15');