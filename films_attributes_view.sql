CREATE OR REPLACE VIEW public.film_attributes AS
 SELECT f.name,
    attr_t.name AS attribute_type,
    attr.name AS attribute_name,
        CASE
            WHEN ((attr_t.name)::text = 'integer'::text) THEN (f_attr.value_integer)::text
            WHEN ((attr_t.name)::text = 'double precision'::text) THEN (f_attr.value_float)::text
            WHEN ((attr_t.name)::text = 'boolean'::text) THEN
            CASE
                WHEN (f_attr.value_boolean = true) THEN 'Y'::text
                ELSE 'N'::text
            END
            WHEN ((attr_t.name)::text = 'timestamp'::text) THEN (f_attr.value_timestamp)::text
            WHEN ((attr_t.name)::text = 'text'::text) THEN (f_attr.value_text)::text
            ELSE NULL::text
        END AS attribute_value
   FROM (((public.attribute_type attr_t
     JOIN public.attribute attr ON ((attr_t.attribute_type_id = attr.attribute_type_id)))
     JOIN public.film_attributes f_attr ON ((attr.attribute_id = f_attr.attribute_id)))
     JOIN public.film f ON ((f_attr.film_id = f.film_id)))
  GROUP BY f.film_id, attr_t.attribute_type_id, attr.attribute_id, f_attr.film_attributes_id;