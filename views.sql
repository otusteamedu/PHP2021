create view show_tasks as
	select films.name as film_name,
		string_agg((case when date_trunc('day', fv.value_timestamp) = date_trunc('day', current_timestamp) then concat(fa.name, ';') else '' end), '') as today_tasks,
		string_agg((case when date_trunc('day', fv.value_timestamp) = date_trunc('day', current_timestamp + interval '20 day') then concat(fa.name, ';') else '' end), '') as after_20_days_task
	from films
		left join films_values fv on films.id = fv.film_id
		left join films_attributes fa on fv.attribute_id = fa.id 
		left join films_attributes_types fat on fat.id = fa.type_id
	where fat.name = 'value_timestamp'
	group by films.id

	
create view film_attributes as
	select films.name as film_name, fat.name as attribute_type_name, fa.name as film_attribute_name,
		(case 
			when fat.name = 'value_text' then fv.value_text::text
			when fat.name = 'value_boolean' then (case when fv.value_boolean then 'Да' else 'Нет' end)
			when fat.name = 'value_timestamp' then fv.value_timestamp::text
			when fat.name = 'value_integer' then fv.value_integer::text
			when fat.name = 'value_float' then fv.value_float::text
			when fat.name = 'value_varchar' then fv.value_varchar::text
		end) as value
	from films
		join films_values fv on films.id = fv.film_id
		join films_attributes fa on fv.attribute_id = fa.id 
		join films_attributes_types fat on fat.id = fa.type_id
	order by films.name asc;
