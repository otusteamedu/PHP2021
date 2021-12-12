create table films (
	id SERIAL not null,
	name character varying(150) unique,
	primary key(id)
);

create table films_attributes_types (
	id SERIAL not null,
	name character varying(150) unique,
	primary key(id)
);

create table films_attributes (
	id SERIAL not null,
	type_id INT not null,
	name character varying(150) unique,
	primary key(id),
	foreign key(type_id) references films_attributes_types(id)
);

create table films_values (
	id SERIAL not null,
	film_id INT not null,
	attribute_id INT not null,
	value_text text,
	value_boolean boolean,
	value_timestamp timestamp,
	value_integer integer,
	value_float double precision,
	value_varchar character varying,
	primary key(id),
	foreign key(film_id) references films(id),
	foreign key(attribute_id) references films_attributes(id)
);

create index films_name on films (name);
create index films_attributes_types_name on films_attributes_types (name);
