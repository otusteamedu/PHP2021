CREATE TABLE movies (
    id serial PRIMARY KEY,
    name varchar NOT NULL
);

CREATE TABLE attribute_types (
    id serial PRIMARY KEY,
    type varchar NOT NULL UNIQUE
);

CREATE TABLE attributes (
    id serial PRIMARY KEY,
    attribute_type_id integer NOT NULL,
    title varchar NOT NULL UNIQUE,

    FOREIGN KEY (attribute_type_id) REFERENCES attribute_types (id)
);

CREATE TABLE values (
    id serial PRIMARY KEY,
    movie_id integer NOT NULL,
    attribute_id integer NOT NULL,
    value_integer integer,
    value_text text,
    value_float float,
    value_date date,
    value_boolean boolean,

    FOREIGN KEY (movie_id) REFERENCES movies (id),
    FOREIGN KEY (attribute_id) REFERENCES attributes (id)
);

CREATE INDEX values_date on values (value_date);
CREATE INDEX values_movie_id on values (movie_id);
CREATE INDEX values_attribute_id on values (attribute_id);

CREATE VIEW management (movie, attribute_type, attribute, value) AS
    SELECT
        movies.name,
        attribute_types.type,
        attributes.title,
        COALESCE(
            values.value_integer::text,
            values.value_text,
            values.value_float::text,
            values.value_date::text,
            values.value_boolean::text
        ) as value
    FROM movies
    JOIN values ON movies.id=values.movie_id
    JOIN attributes ON attributes.id=values.attribute_id
    JOIN attribute_types ON attribute_types.id=attributes.attribute_type_id
    ORDER BY movies.id
;

CREATE VIEW service (movie, today, in_20_days) AS
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

