-- Наполение таблицы фильмов
INSERT INTO
    public.movies (id, "name")
VALUES
    (1, 'Home Alone'),
    (2, 'Godfather');

-- Наполение таблицы типов атрибутов
INSERT INTO
    public.movie_attr_types (id, "name", property)
VALUES
    (1, 'int', NULL),
    (2, 'float', 'decimal(12,2)'),
    (3, 'bool', NULL),
    (4, 'text', NULL),
    (5, 'date', 'main'),
    (6, 'date', 'service');

-- Наполение таблицы атрибутов
INSERT INTO
    public.movie_attrs (id, "name", type_id)
VALUES
    (1, 'annotation', 4),
    (2, 'review', 4),
    (3, 'oscar', 3),
    (4, 'golden_globes', 3),
    (5, 'world_premiere', 5),
    (6, 'local_premiere', 5),
    (7, 'ticket_start', 6),
    (8, 'adver_start', 6),
    (9, 'box_office', 2);

-- Наполение таблицы значений атрибутов
INSERT INTO
    public.movie_attr_values (movie_id, attr_id,
                              value_int, value_float, value_bool,
                              value_text, value_date_m, value_date_s)
VALUES
    (1, 1, NULL, NULL, NULL, 'some home alone annotation', NULL, NULL),
    (1, 2, NULL, NULL, NULL, 'some home alone review', NULL, NULL),
    (1, 5, NULL, NULL, NULL, NULL, '1990-11-10', NULL),
    (1, 6, NULL, NULL, NULL, NULL, '1993-12-27', NULL),
    (1, 7, NULL, NULL, NULL, NULL, NULL, '2021-12-25'),
    (1, 8, NULL, NULL, NULL, NULL, NULL, '2021-12-01'),
    (2, 1, NULL, NULL, NULL, 'some godfather annotation', NULL, NULL),
    (2, 2, NULL, NULL, NULL, 'some godfather review', NULL, NULL),
    (2, 3, NULL, NULL, true, NULL, NULL, NULL),
    (2, 4, NULL, NULL, true, NULL, NULL, NULL),
    (2, 5, NULL, NULL, NULL, NULL, '1972-03-14', NULL),
    (2, 7, NULL, NULL, NULL, NULL, NULL, '2022-02-24');
