CREATE VIEW "service_view" AS
SELECT
    films.name,
    array_agg(CASE WHEN t.timestamp_value=CURRENT_DATE::TIMESTAMP THEN t.name ELSE '' END) today_tasks,
    array_agg(CASE WHEN t.timestamp_value=(CURRENT_DATE + INTERVAL '20 DAY')::TIMESTAMP THEN t.name ELSE '' END) after_20_days_tasks
FROM films
         LEFT JOIN (
    SELECT fav.*, fa.name FROM film_attribute_values  fav
       INNER JOIN film_attributes fa ON fa.id=fav.film_attribute_id
       INNER JOIN film_attribute_types fat on fa.film_attribute_type_id = fat.id
    WHERE fav.timestamp_value IN (CURRENT_DATE::TIMESTAMP, (CURRENT_DATE + INTERVAL '20 DAY')::TIMESTAMP)
      AND fat.id=3
) t ON t.film_id=films.id
GROUP BY films.id
ORDER BY films.id ASC;


CREATE VIEW "marketing_view" AS
SELECT
    f.name film_name,
    fat.name film_attribute_type_name,
    fa.name film_attribute_name,
    (
            CASE WHEN fav.varchar_value IS NOT NULL THEN fav.varchar_value || ' ' ELSE '' END
            || CASE WHEN fav.int_value IS NOT NULL THEN fav.int_value || ' ' ELSE '' END
            || CASE WHEN fav.timestamp_value IS NOT NULL THEN to_char(fav.timestamp_value, 'DD.MM.YYYY HH24:MI:SS') || ' ' ELSE '' END
        ) film_attribute_value
FROM film_attributes fa
         INNER JOIN film_attribute_types fat ON fat.id = fa.film_attribute_type_id
         INNER JOIN film_attribute_values fav ON fav.film_attribute_id = fa.id
         INNER JOIN films f ON f.id = fav.film_id
ORDER BY f.id ASC, fat.id ASC, fa.id ASC;