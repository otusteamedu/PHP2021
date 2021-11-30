DROP VIEW IF EXISTS service_events;

CREATE VIEW service_events AS
    SELECT 
	m.name
	, array_remove(array_agg(CASE WHEN av.value_date = now()::date THEN a.name END), NULL) today_events
	, array_remove(array_agg(CASE WHEN av.value_date = now()::date + interval '20 day' THEN a.name END), NULL) future_events
    FROM attribute_type at
    JOIN attribute a ON a.attribute_type_id = at.id
    JOIN attribute_value av ON av.attribute_id = a.id
    JOIN movie m ON m.id = av.movie_id
    WHERE at.id=5 AND (av.value_date = now()::date OR av.value_date = now()::date + interval '20 day')
    GROUP BY m.id
;