CREATE OR REPLACE VIEW public.film_attributes
AS SELECT films.name AS film_name,
          attribute_type.name AS attribute_type_name,
          attribute.name AS attribute_name,
          CASE
              WHEN attribute_value."int" IS NOT NULL THEN attribute_value."int"::text
              WHEN attribute_value."float" IS NOT NULL THEN attribute_value."float"::text
              WHEN attribute_value.text IS NOT NULL THEN attribute_value.text
              WHEN attribute_value.datetime IS NOT NULL THEN attribute_value.datetime::text
              WHEN attribute_value.bool IS NOT NULL THEN attribute_value.bool::text
              ELSE NULL::text
                     END AS attribute_value_name
   FROM films
            LEFT JOIN attribute_value ON films.id = attribute_value.film
            LEFT JOIN attribute ON attribute_value.attribute = attribute.id
            LEFT JOIN attribute_type ON attribute.attribute_type = attribute_type.id;

CREATE OR REPLACE VIEW public.film_tasks
AS SELECT films.name AS film_name,
          CASE
              WHEN attribute_value.datetime::date = now()::date THEN attribute_value.datetime
            ELSE NULL::timestamp without time zone
END AS today,
        CASE
            WHEN attribute_value.datetime::date = (now()::date + '20 days'::interval) THEN attribute_value.datetime
            ELSE NULL::timestamp without time zone
END AS future
   FROM films
     LEFT JOIN attribute_value ON films.id = attribute_value.attribute
     LEFT JOIN attribute ON attribute_value.attribute = attribute.id
     LEFT JOIN attribute_type ON attribute.attribute_type = attribute_type.id
  WHERE attribute_type.name::text = 'dateTime'::text AND (attribute_value.datetime::date = now()::date OR attribute_value.datetime = (now()::date + '20 days'::interval))
  GROUP BY films.name, (
        CASE
            WHEN attribute_value.datetime::date = now()::date THEN attribute_value.datetime
            ELSE NULL::timestamp without time zone
        END), (
        CASE
            WHEN attribute_value.datetime::date = (now()::date + '20 days'::interval) THEN attribute_value.datetime
            ELSE NULL::timestamp without time zone
        END);