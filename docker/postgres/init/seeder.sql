INSERT INTO movies (name) VALUES
('movie 1'),
('movie 2'),
('movie 3'),
('movie 4'),
('movie 5')
;

INSERT INTO attribute_types (type) VALUES
('integer'),
('text'),
('float'),
('timestamp'),
('boolean')
;

INSERT INTO attributes (attribute_type_id, title) VALUES
(2, 'review'),
(5, 'nika'),
(5, 'oskar'),
(5, 'teffi'),
(4, 'world premiere'),
(4, 'russia premiere'),
(4, 'start advertisement')
;

INSERT INTO values (movie_id, attribute_id, value_text) VALUES
(1, 1, 'Review 1'),
(2, 1, 'Review 2'),
(3, 1, 'Review 3'),
(4, 1, 'Review 4'),
(5, 1, 'Review 5')
;

INSERT INTO values (movie_id, attribute_id, value_boolean) VALUES
(1, 2, true),
(2, 2, true),
(3, 2, true),
(4, 3, true),
(5, 3, true),
(1, 3, true),
(2, 4, true),
(5, 4, true)
;

INSERT INTO values (movie_id, attribute_id, value_date) VALUES
(1, 5, '2021-09-08'),
(2, 5, '2021-09-25'),
(3, 5, '2021-09-05'),
(4, 5, '2021-09-25'),
(5, 5, '2021-09-25'),
(1, 6, '2021-09-25'),
(2, 6, '2021-09-11'),
(3, 6, '2021-09-04'),
(4, 6, '2021-09-17'),
(5, 6, '2021-09-05'),
(1, 7, '2021-08-18'),
(2, 7, '2021-09-01'),
(3, 7, '2021-09-05'),
(4, 7, '2021-09-01'),
(5, 7, '2021-09-02')
;
