CREATE VIEW marketing (films, attributes_types, attributes, films_values) AS
SELECT m.name, at.name, a.name,
   CASE
       WHEN at.id = 1 THEN av.value_integer::text
       WHEN at.id = 2 THEN av.value_float::text
       WHEN at.id = 3 THEN (CASE WHEN av.value_boolean=true THEN 'Y' ELSE 'N' END)
       WHEN at.id = 4 THEN av.value_text
       WHEN at.id = 5 THEN av.value_timestamp::text
   END AS films_values
FROM films m
    JOIN films_values av ON av.film_id = m.id
    JOIN attributes a ON a.id = av.attribute_id
    JOIN attributes_types at ON at.id=a.id
    GROUP BY m.id, at.id, a.id, av.id