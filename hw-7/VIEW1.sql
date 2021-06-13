CREATE OR REPLACE VIEW service AS (
	SELECT
		films.name,
		string_agg(
		CASE
			WHEN attribute_values.value_date = CURRENT_DATE THEN attributes.name
		END, ', ') as today,
		string_agg(CASE
			WHEN attribute_values.value_date >= CURRENT_DATE+20 THEN attributes.name
		END, ', ') as in20day
	FROM films
	JOIN attribute_values ON films.id = attribute_values.film_id
	JOIN attributes ON attribute_values.attribute_id = attributes.id
	JOIN attribute_types ON attributes.attribute_type_id = attribute_types.id WHERE attribute_types.code = 'service_date'
	GROUP BY films.id
);