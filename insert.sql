INSERT INTO `movies` (`id`, `title`) VALUES
(1, 'The Shawshank Redemption'),
(2, 'The Godfather');

INSERT INTO `movies_attribute_types` (`name`, `title`) VALUES
('boolean', 'Логическое значение'),
('date_public', 'Дата: публичная'),
('date_service', 'Дата: служебная'),
('integer', 'Целочисленное значение'),
('float', 'Значение с плавающей точкой'),
('string', 'Строка'),
('text', 'Текст');

INSERT INTO `movies_attributes` (`id`, `type`, `title`) VALUES
(1, 'boolean', 'Oscars 2021: Best Movie'),
(2, 'boolean', 'Oscars 2020: Best Movie'),
(3, 'text', 'Обзор (кинокритика)'),
(4, 'text', 'Обзор (пользователя сайта)'),
(5, 'string', 'Режиссер'),
(6, 'string', 'Продюссер'),
(7, 'integer', 'Продолжительность (в минутах)'),
(8, 'integer', 'Сборы в России (в рублях)'),
(9, 'date_public', 'Мировая премьера'),
(10, 'date_public', 'Премьера в России'),
(11, 'date_public', 'Премьера на Disney Plus'),
(12, 'date_service', 'Дата запуска рекламы'),
(13, 'date_service', 'Дата релиза трейлера'),
(14, 'float', 'Рейтинг');

INSERT INTO `movies_attribute_values` (`id`, `movie`, `attribute`, `value_boolean`, `value_integer`, `value_float`, `value_string`, `value_date`, `value_text`) VALUES
(1, 1, 1, '1', NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, '0', NULL, NULL, NULL, NULL, NULL),
(3, 1, 3, NULL, NULL, NULL, NULL, NULL, 'Положительный обзор кинокритика...'),
(4, 1, 4, NULL, NULL, NULL, NULL, NULL, 'Нейтральный обзор пользователя...'),
(5, 1, 5, NULL, NULL, NULL, 'Frank Darabont', NULL, NULL),
(6, 1, 6, NULL, NULL, NULL, 'Castle Rock Entertainment', NULL, NULL),
(7, 1, 7, NULL, 142, NULL, NULL, NULL, NULL),
(8, 1, 8, NULL, 26000897, NULL, NULL, NULL, NULL),
(9, 1, 9, NULL, NULL, NULL, NULL, '2021-06-01', NULL),
(10, 1, 10, NULL, NULL, NULL, NULL, '2021-07-01', NULL),
(11, 1, 11, NULL, NULL, NULL, NULL, '2021-08-01', NULL),
(12, 1, 12, NULL, NULL, NULL, NULL, '2021-05-01', NULL),
(13, 1, 13, NULL, NULL, NULL, NULL, '2021-05-15', NULL),
(14, 2, 1, '0', NULL, NULL, NULL, NULL, NULL),
(15, 2, 2, '1', NULL, NULL, NULL, NULL, NULL),
(16, 2, 3, NULL, NULL, NULL, NULL, NULL, 'Положительный обзор кинокритика...'),
(17, 2, 4, NULL, NULL, NULL, NULL, NULL, 'Нейтральный обзор пользователя...'),
(18, 2, 5, NULL, NULL, NULL, 'Francis Ford Coppola', NULL, NULL),
(19, 2, 6, NULL, NULL, NULL, 'Paramount Pictures', NULL, NULL),
(20, 2, 7, NULL, 175, NULL, NULL, NULL, NULL),
(21, 2, 8, NULL, 46000891, NULL, NULL, NULL, NULL),
(22, 2, 9, NULL, NULL, NULL, NULL, '2020-06-01', NULL),
(23, 2, 10, NULL, NULL, NULL, NULL, '2020-07-01', NULL),
(24, 2, 11, NULL, NULL, NULL, NULL, '2020-08-01', NULL),
(25, 2, 12, NULL, NULL, NULL, NULL, '2020-05-01', NULL),
(26, 2, 13, NULL, NULL, NULL, NULL, '2020-05-16', NULL),
(27, 1, 14, NULL, NULL, '9.80', NULL, NULL, NULL),
(28, 2, 14, NULL, NULL, '9.87', NULL, NULL, NULL);
