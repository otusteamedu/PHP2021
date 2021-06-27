-- base
CREATE TABLE films (
    id_film int NOT NULL PRIMARY KEY,
    title text NOT NULL
);

CREATE TABLE attr (
    id_attr int NOT NULL PRIMARY KEY,
    title text NOT NULL,
    id_type int NOT NULL,
    category text DEFAULT ''
);

CREATE TABLE attr_type (
    id_type int NOT NULL PRIMARY KEY,
    type CHAR(10) NOT NULL
);

CREATE TABLE attr_values (
    id serial NOT NULL PRIMARY KEY,
    id_film int NOT NULL,
    id_attr int NOT NULL,
    data_int int,
    data_float float,
    data_text text,
    data_date date
);

-- insert films
INSERT INTO films VALUES (1, 'Телохранитель жены киллера');
INSERT INTO films VALUES (2, 'Круэлла');
INSERT INTO films VALUES (3, 'Лука');

-- insert attr
INSERT INTO attr VALUES (1, 'Год производства', 1);
INSERT INTO attr VALUES (2, 'Рейтинг', 2);
INSERT INTO attr VALUES (3, 'Страна', 3);
INSERT INTO attr VALUES (4, 'Дата начала продажи билетов', 4, 'Служебные');
INSERT INTO attr VALUES (5, 'Дата запуска рекламы', 4, 'Служебные');

-- insert attr type
INSERT INTO attr_type VALUES (1, 'int');
INSERT INTO attr_type VALUES (2, 'float');
INSERT INTO attr_type VALUES (3, 'text');
INSERT INTO attr_type VALUES (4, 'date');

-- insert attr values
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (1, 1, 2021, NULL, NULL, NULL);
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (1, 2, NULL, 7.5, NULL, NULL);
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (1, 3, NULL, NULL, 'США', NULL);
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (1, 4, NULL, NULL, NULL, '2021-06-27');
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (1, 5, NULL, NULL, NULL, '2021-05-27');

INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (2, 1, 2021, NULL, NULL, NULL);
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (2, 2, NULL, 5.5, NULL, NULL);
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (2, 3, NULL, NULL, 'Великобритания', NULL);
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (2, 4, NULL, NULL, NULL, '2021-06-27');
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (2, 5, NULL, NULL, NULL, '2021-05-27');

INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (3, 1, 2021, NULL, NULL, NULL);
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (3, 2, NULL, 8.9, NULL, NULL);
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (3, 3, NULL, NULL, 'Япония', NULL);
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (3, 4, NULL, NULL, NULL, '2021-06-27');
INSERT INTO attr_values (id_film, id_attr, data_int, data_float, data_text, data_date) VALUES (3, 5, NULL, NULL, NULL, '2021-05-27');