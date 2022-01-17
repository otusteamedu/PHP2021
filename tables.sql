create table films (
    id SERIAL,
    name varchar(200) unique,
    primary key(id)
);

create table attributes_types (
    id SERIAL,
    name varchar(200) unique,
    primary key(id)
);

create table attributes (
    id SERIAL,
    type_id INT not null,
    name varchar(150) unique,
    primary key(id),
    foreign key(type_id) references attributes_types(id)
);

create table films_values (
                              id SERIAL,
                              film_id INT not null,
                              attribute_id INT not null,
                              value_text text,
                              value_boolean boolean,
                              value_timestamp timestamp,
                              value_integer integer,
                              value_float double precision,
                              primary key(id),
                              foreign key(film_id) references films(id),
                              foreign key(attribute_id) references attributes(id)
);

create index films_name on films (name);
create index attributes_types_name on attributes_types (name);