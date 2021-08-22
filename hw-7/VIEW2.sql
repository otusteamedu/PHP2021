CREATE OR REPLACE VIEW marketing AS (
	SELECT
		films.name,
		attribute_types.name as type,
		attributes.name as attribute,
		COALESCE(
			attribute_values.value_text,
			attribute_values.value_date::text,
			attribute_values.value_int::text,
			attribute_values.value_bool::text,
			attribute_values.value_float::text,
			attribute_values.value_time::text,
			''
		) as value
	FROM films
	JOIN attribute_values ON attribute_values.film_id = films.id
	JOIN attributes ON attributes.id = attribute_values.attribute_id
	JOIN attribute_types ON attribute_types.id = attributes.attribute_type_id
	ORDER BY films.id, attribute_types.id, attributes.id
);