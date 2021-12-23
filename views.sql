CREATE OR REPLACE VIEW films_tasks AS
    SELECT 
		f.name, 
		array_to_string(ARRAY( 
			SELECT (av1.date || ' ' || a1.attribute_name) 
			FROM attribute_values as av1 
			LEFT JOIN attributes AS a1 ON a1.id = av1.attribute_id
			WHERE av1.date = CURRENT_DATE
			AND av1.film_id = f.id),', ') AS tasks_today,
		array_to_string(ARRAY( 
			SELECT (av2.date || ' ' || a2.attribute_name) 
			FROM attribute_values as av2 
			LEFT JOIN attributes AS a2 ON a2.id = av2.attribute_id
			WHERE av2.date >= date(CURRENT_DATE+20)
			AND av2.film_id = f.id),', ') AS tasks_20day	
    FROM films as f;

CREATE OR REPLACE VIEW films_attributes AS
    SELECT 
		f.name as film_name, 
		at.attribute_type_name as attribute_type,
		a.attribute_name,
		(CASE 
			WHEN at.attribute_type_name='boolean' 
				THEN av.id::text
            WHEN at.attribute_type_name='date' 
				THEN av.date::text
            WHEN at.attribute_type_name='integer'
                THEN av.integer::text
            ELSE av.text
       	END) as attribute_value
    FROM films as f
    LEFT JOIN attribute_values AS av 
	ON av.film_id = f.id
	LEFT JOIN attributes AS a 
	ON a.id = av.attribute_id
	LEFT JOIN attribute_types AS at 
	ON at.id = a.attribute_type_id;