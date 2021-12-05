create view show_tasks as
	select films.name as film_name,
		string_agg((case when date_trunc('day', fv.value::timestamp) = date_trunc('day', current_timestamp) then concat(fa.name, ';') else '' end), '') as today_tasks,
		string_agg((case when date_trunc('day', fv.value::timestamp) = date_trunc('day', current_timestamp + interval '20 day') then concat(fa.name, ';') else '' end), '') as after_20_days_task
	from films
		left join films_values fv on films.id = fv.film_id
		left join films_attributes fa on fv.attribute_id = fa.id 
		left join films_attributes_types fat on fat.id = fa.type_id
	where fat.name = 'date'
	group by films.id

	
create view film_attributes as
	select films.name as film_name, fat.name as attribute_type_name, fa.name as film_attribute_name,
		fv.value::TEXT
	from films
		left join films_values fv on films.id = fv.film_id
		left join films_attributes fa on fv.attribute_id = fa.id 
		left join films_attributes_types fat on fat.id = fa.type_id
	where fv.value != ''
	order by films.name asc;