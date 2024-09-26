CREATE VIEW service_data SELECT (SELECT title FROM films WHERE attr_values.id_film = id_film) AS title,
(SELECT title FROM attr WHERE id_attr = attr_values.id_attr) AS today, 
'' AS next20day
FROM attr_values WHERE id_attr IN (SELECT id_attr FROM attr WHERE category = 'Служебные') AND data_date = (SELECT CURRENT_DATE)
UNION ALL
SELECT (SELECT title FROM films WHERE attr_values.id_film = id_film) AS title,
'' AS today,
(SELECT title FROM attr WHERE id_attr = attr_values.id_attr) AS next20day
FROM attr_values WHERE id_attr IN (SELECT id_attr FROM attr WHERE category = 'Служебные') AND data_date >= (SELECT CURRENT_DATE + 20)