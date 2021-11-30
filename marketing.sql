DROP VIEW IF EXISTS marketing;

CREATE VIEW marketing (movie, attribute_type, attribute, value) AS
    SELECT 
	m.name
	, at.name
	, a.name
	, CASE 
		WHEN at.id = 1 THEN av.value_int::text
		WHEN at.id = 2 THEN to_char(av.value_num, '99999999999999999999D99S')
		WHEN at.id = 3 THEN (CASE WHEN av.value_bool=true THEN 'Y' ELSE 'N' END)
		WHEN at.id = 4 THEN av.value_text
		WHEN at.id = 5 THEN av.value_date::text
	END AS value
    FROM movie m
    JOIN attribute_value av ON av.movie_id = m.id
    JOIN attribute a ON a.id = av.attribute_id
    JOIN attribute_type at ON at.id=a.attribute_type_id
    GROUP BY m.id, at.id, a.id, av.id
;
