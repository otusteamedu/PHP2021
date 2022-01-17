CREATE VIEW service (films) AS
SELECT m.name,
       array_remove(array_agg(CASE WHEN av.value_timestamp = now()::date THEN a.name END), NULL) today,
       array_remove(array_agg(CASE WHEN av.value_timestamp = now()::date + interval '20 day' THEN a.name END), NULL) future

FROM attributes_types at
    JOIN attributes a ON a.type_id = at.id
    JOIN films_values av ON av.attribute_id = a.id
    JOIN films m ON m.id = av.film_id
    WHERE at.id=5 AND (av.value_timestamp = now()::date OR av.value_timestamp = now()::date)
    GROUP BY m.id;