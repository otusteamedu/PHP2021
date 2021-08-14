CREATE VIEW public."service_view" AS
SELECT
	f.name,
	array_agg(CASE WHEN t.value_timestamp=CURRENT_DATE::TIMESTAMP THEN t.name ELSE '' END) today_tasks,
	array_agg(CASE WHEN t.value_timestamp=(CURRENT_DATE + INTERVAL '20 DAY')::TIMESTAMP THEN t.name ELSE '' END) today_plus_20days_tasks
FROM public.film f
LEFT JOIN (
	SELECT
		fav.*,
		fa.name
	FROM public."filmAttributeValue" fav
	INNER JOIN public."filmAttribute" fa ON fa.id=fav.film_attribute_id
	WHERE fav.value_timestamp IN(CURRENT_DATE::TIMESTAMP, (CURRENT_DATE + INTERVAL '20 DAY')::TIMESTAMP)
	AND fa.film_attribute_type_id=4
) t ON t.film_id=f.id
GROUP BY f.id
ORDER BY f.id ASC;

CREATE VIEW public."marketing_view" AS
SELECT
	f.name film_name,
	fat.name film_attribute_type_name,
	fa.name film_attribute_name,
	(
		CASE WHEN fav.value_string IS NOT NULL THEN fav.value_string || ' ' ELSE '' END
		|| CASE WHEN fav.value_text IS NOT NULL THEN fav.value_text || ' ' ELSE '' END
		|| CASE WHEN fav.value_integer IS NOT NULL THEN fav.value_integer || ' ' ELSE '' END
		|| CASE WHEN fav.value_numeric IS NOT NULL THEN fav.value_numeric || ' ' ELSE '' END
		|| CASE WHEN fav.value_boolean IS NOT NULL THEN (
			CASE WHEN fav.value_boolean=TRUE THEN 'Да ' ELSE 'Нет ' END
		) ELSE '' END
		|| CASE WHEN fav.value_timestamp IS NOT NULL THEN to_char(fav.value_timestamp, 'DD.MM.YYYY HH24:MI:SS') || ' ' ELSE '' END
		|| CASE WHEN fav.value_interval IS NOT NULL THEN fav.value_interval || ' ' ELSE '' END
	) film_attribute_value
FROM public."filmAttribute" fa
INNER JOIN public."filmAttributeType" fat ON fat.id = fa.film_attribute_type_id
INNER JOIN public."filmAttributeValue" fav ON fav.film_attribute_id = fa.id
INNER JOIN public."film" f ON f.id = fav.film_id
ORDER BY f.id ASC, fat.id ASC, fa.id ASC;