--
-- Name: film_tasks _RETURN; Type: RULE; Schema: public; Owner: bender
--

CREATE OR REPLACE VIEW public.film_tasks AS
 SELECT f.name,
    array_agg(
        CASE
            WHEN ((f_attr.value_date - CURRENT_DATE) = 0) THEN attr.name
            ELSE NULL::character varying
        END) AS today_tasks,
    array_agg(
        CASE
            WHEN ((f_attr.value_date - CURRENT_DATE) = 20) THEN attr.name
            ELSE NULL::character varying
        END) AS twenty_days_tasks
   FROM (((public.attribute_type attr_t
     JOIN public.attribute attr ON ((attr_t.attribute_type_id = attr.attribute_type_id)))
     JOIN public.film_attributes f_attr ON ((attr.attribute_id = f_attr.attribute_id)))
     JOIN public.film f ON ((f_attr.film_id = f.film_id)))
  WHERE ((attr_t.attribute_type_id = 4) AND (((f_attr.value_date - CURRENT_DATE) = 0) OR ((f_attr.value_date - CURRENT_DATE) > 19)))
  GROUP BY f.film_id;


--
-- Name: film_attributes_values _RETURN; Type: RULE; Schema: public; Owner: bender
--

CREATE OR REPLACE VIEW public.film_attributes_values AS
 SELECT f.name,
    attr_t.name AS attribute_type,
    attr.name AS attribute_name,
        CASE
            WHEN ((attr_t.name)::text = 'integer'::text) THEN (f_attr.value_integer)::character varying
            WHEN ((attr_t.name)::text = 'numeric'::text) THEN (f_attr.value_numeric)::character varying
            WHEN ((attr_t.name)::text = 'boolean'::text) THEN (
            CASE
                WHEN (f_attr.value_boolean = true) THEN 'Y'::text
                ELSE 'N'::text
            END)::character varying
            WHEN ((attr_t.name)::text = 'date'::text) THEN (f_attr.value_date)::character varying
            ELSE NULL::character varying
        END AS attribute_value
   FROM (((public.attribute_type attr_t
     JOIN public.attribute attr ON ((attr_t.attribute_type_id = attr.attribute_type_id)))
     JOIN public.film_attributes f_attr ON ((attr.attribute_id = f_attr.attribute_id)))
     JOIN public.film f ON ((f_attr.film_id = f.film_id)))
  GROUP BY f.film_id, attr_t.attribute_type_id, attr.attribute_id, f_attr.film_attributes_id;
