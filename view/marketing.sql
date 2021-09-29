CREATE OR REPLACE VIEW public.marketing
AS SELECT movies.name AS "Фильм",
    types_attributes.type AS "Тип атрибута",
    attributes.name AS "Атрибут",
    COALESCE(values.value_text, values.value_int::text, values.value_boolean::text, values.value_float::text, values.value_date::text) AS "Значение"
   FROM movies
     JOIN values ON movies.id = "values".id_movie
     JOIN attributes ON attributes.id = "values".id_attribute
     JOIN types_attributes ON types_attributes.id = attributes.id_types_attributes
  ORDER BY movies.id;