create table halls
(
    id       bigint unsigned auto_increment
        primary key,
    name     varchar(255) not null,
    capacity int          not null
);

INSERT INTO halls (name, capacity)
values ('Красный зал', 203),
       ('Синий зал', 150);


create table movies
(
    id       bigint unsigned auto_increment
        primary key,
    name     varchar(255) not null,
    duration time         not null
);

INSERT INTO movies (name, duration)
values ('1+1', '01:53:00'),
       ('Начало', '02:42:00'),
       ('Брат', '01:40:00'),
       ('Брат2', '02:07:00'),
       ('Аватар', '02:42:00'),
       ('Титаник', '03:30:00');

create table seances
(
    id         bigint unsigned auto_increment
        primary key,
    hall_id    bigint unsigned not null,
    movie_id   bigint unsigned not null,
    started_at datetime        not null,
    constraint seances_hall_id_foreign
        foreign key (hall_id) references halls (id)
            on delete cascade,
    constraint seances_movie_id_foreign
        foreign key (movie_id) references movies (id)
            on delete cascade
);

INSERT INTO seances (hall_id, movie_id, started_at)
values (1, 1, '2021-06-01 15:49:55'),
       (2, 2, '2021-06-01 16:57:22'),
       (1, 3, '2021-06-01 11:58:01'),
       (2, 3, '2021-06-01 11:58:01'),
       (1, 1, '2021-06-01 11:58:01');

create table orders
(
    id         bigint unsigned auto_increment
        primary key,
    seance_id  bigint unsigned not null,
    name       varchar(255)    not null,
    full_price int             not null,
    create_at  datetime        not null,
    constraint orders_seance_id_foreign
        foreign key (seance_id) references seances (id)
            on delete cascade
);

INSERT INTO orders (seance_id, name, full_price, create_at)
values (1, 'Иван Плюшкин', 100, '2021-06-01 15:50:16'),
       (3, 'Петр Иванов', 1000, '2021-06-01 16:03:11'),
       (2, 'Алексей Петров', 520, '2021-06-01 16:03:55'),
       (5, 'Валентин Васильев', 100, '2021-06-01 16:04:30'),
       (1, 'Евгений Сустов', 150, '2021-06-01 16:03:55'),
       (2, 'Петр Иванов', 680, '2021-06-01 16:04:30'),
       (5, 'Иван Плюшкин', 100, '2021-06-01 15:50:16'),
       (4, 'Петр Иванов', 100, '2021-06-01 16:03:11');


create table tickets
(
    id       bigint unsigned auto_increment
        primary key,
    order_id bigint unsigned not null,
    place    int             not null,
    price    int             not null,
    constraint tickets_order_id_foreign
        foreign key (order_id) references orders (id)
            on delete cascade
);

INSERT INTO tickets (order_id, place, price)
values (1, 13, 100),
       (3, 24, 100),
       (2, 35, 100),
       (4, 23, 100),
       (1, 34, 100);