CREATE OR REPLACE VIEW public.service
AS SELECT movies.name AS "Фильм",
    string_agg(
        CASE
            WHEN values.value_date = CURRENT_DATE THEN attributes.name
            ELSE NULL::character varying
        END::text, ':'::text) AS "Сегодня",
    string_agg(
        CASE
            WHEN values.value_date = (CURRENT_DATE + '20 days'::interval day) THEN attributes.name
            ELSE NULL::character varying
        END::text, ':'::text) AS "Через 20 дней"
   FROM movies
     JOIN values ON movies.id = values.id_movie
     JOIN attributes ON attributes.id = "values".id_attribute
  WHERE values.value_date = CURRENT_DATE OR values.value_date = (CURRENT_DATE + '20 days'::interval day)
  GROUP BY movies.id;