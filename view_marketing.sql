CREATE VIEW marketing AS SELECT (SELECT title FROM films WHERE attr_values.id_film = id_film) AS title, 
(SELECT type FROM attr_type WHERE id_type = (SELECT id_type FROM attr WHERE id_attr = attr_values.id_attr)) AS type, 
(SELECT title FROM attr WHERE id_attr = attr_values.id_attr) AS attr,  
CASE WHEN data_int IS NOT NULL
THEN CAST(data_int AS TEXT)
WHEN data_float IS NOT NULL
THEN CAST(data_float AS TEXT)
WHEN data_text IS NOT NULL
THEN data_text
WHEN data_date IS NOT NULL
THEN CAST(data_date AS TEXT)
WHEN data_bool IS NOT NULL
THEN CAST(data_bool AS TEXT)
END AS value
FROM attr_values