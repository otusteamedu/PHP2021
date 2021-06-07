create table if not exists film
(
    id serial not null
        constraint film_pk
            primary key,
    name varchar(255) not null,
    minute_duration integer
);

alter table film owner to postgres;

create table if not exists cinema
(
    id serial not null
        constraint cinema_pk
            primary key,
    name varchar(255) not null,
    address varchar(255)
);

alter table cinema owner to postgres;

create table if not exists hall
(
    id serial not null
        constraint hall_pk
            primary key,
    cinema_id integer not null
        constraint hall_cinema_id_fk
            references cinema,
    name varchar(255)
);

alter table hall owner to postgres;

create table if not exists session
(
    id serial not null
        constraint session_pk
            primary key,
    hall_id integer not null
        constraint session_hall_id_fk
            references hall,
    film_id integer not null
        constraint session_film_id_fk
            references film,
    date timestamp not null
);

alter table session owner to postgres;

create unique index if not exists session_date_uindex
    on session (date);

create table if not exists zone
(
    id serial not null
        constraint zone_pk
            primary key,
    name varchar(255)
);

alter table zone owner to postgres;

create table if not exists price
(
    id serial not null
        constraint price_pk
            primary key,
    zone_id integer not null
        constraint price_zone_id_fk
            references zone,
    session_id integer not null
        constraint price_session_id_fk
            references session,
    price money not null
);

alter table price owner to postgres;

create table if not exists seat
(
    id serial not null
        constraint seat_pk
            primary key,
    row integer not null,
    "column" integer not null,
    zone_id integer not null,
    hall_id integer not null
        constraint seat_hall_id_fk
            references hall
);

alter table seat owner to postgres;

create table if not exists ticket
(
    id serial not null
        constraint ticket_pk
            primary key,
    session_id integer not null
        constraint ticket_session_id_fk
            references session,
    discount integer default 0 not null,
    seat_id integer not null
        constraint ticket_seat_id_fk
            references seat
);

alter table ticket owner to postgres;
