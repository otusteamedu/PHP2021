CREATE OR REPLACE VIEW management (movie, attribute_type, attribute, value) AS
    SELECT
        movies.name,
        attribute_types.type,
        attributes.title,
        COALESCE(
            values.value_integer,
            values.value_text,
            values.value_float,
            values.value_date,
            values.value_boolean
        ) as value
    FROM movies
    JOIN values ON movies.id=values.movie_id
    JOIN attributes ON attributes.id=values.attribute_id
    JOIN attribute_types ON attribute_types.id=attributes.attribute_type_id
    ORDER BY movies.id
;
