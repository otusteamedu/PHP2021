CREATE OR REPLACE VIEW service (movie, today, in_20_days) AS
    SELECT movies.name,
        string_agg(CASE
            WHEN value_date = current_date
            THEN attributes.title
            END,
            ', '),
        string_agg(CASE
            WHEN value_date = current_date + INTERVAL '20' DAY
            THEN attributes.title
            END,
            ', ')
    FROM movies
    JOIN values ON movies.id=values.movie_id
    JOIN attributes ON attributes.id=values.attribute_id
    WHERE value_date = current_date
    OR value_date = current_date + INTERVAL '20' DAY
    GROUP BY movies.id
    ;
