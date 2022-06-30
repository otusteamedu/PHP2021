CREATE OR REPLACE VIEW public.film_tasks AS
 SELECT f.name,
    array_agg(attr.name) FILTER (WHERE (((CURRENT_TIMESTAMP - f_attr.value_timestamp) < '24:00:00'::interval) AND ((CURRENT_TIMESTAMP - f_attr.value_timestamp) > '00:00:00'::interval))) AS today_tasks,
    array_agg(attr.name) FILTER (WHERE (((f_attr.value_timestamp - CURRENT_TIMESTAMP) > '19 days 23:59:59'::interval) AND ((f_attr.value_timestamp - CURRENT_TIMESTAMP) < '21 days'::interval))) AS twenty_days_tasks
   FROM (((public.attribute_type attr_t
     JOIN public.attribute attr ON ((attr_t.attribute_type_id = attr.attribute_type_id)))
     JOIN public.film_attributes f_attr ON ((attr.attribute_id = f_attr.attribute_id)))
     JOIN public.film f ON ((f_attr.film_id = f.film_id)))
  WHERE ((attr_t.attribute_type_id = 6) AND ((((CURRENT_TIMESTAMP - f_attr.value_timestamp) < '24:00:00'::interval) AND ((CURRENT_TIMESTAMP - f_attr.value_timestamp) > '00:00:00'::interval)) OR (((f_attr.value_timestamp - CURRENT_TIMESTAMP) > '19 days 23:59:59'::interval) AND ((f_attr.value_timestamp - CURRENT_TIMESTAMP) < '21 days'::interval))))
  GROUP BY f.film_id;