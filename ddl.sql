create table halls
(
    id   bigint unsigned auto_increment
        primary key,
    name varchar(255) not null comment 'Название зала'
) collate utf8mb4_unicode_ci;

INSERT INTO halls (name)
values ('Красный зал'),
       ('Синий зал');

create table movies
(
    id       bigint unsigned auto_increment
        primary key,
    name     varchar(255) not null comment 'Название фильма',
    duration time         not null comment 'Продолжительность фильма'
) collate = utf8mb4_unicode_ci;

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
) collate = utf8mb4_unicode_ci;

create
index seances_hall_id_index
    on seances (hall_id);

create
index seances_movie_id_index
    on seances (movie_id);

INSERT INTO seances(hall_id, movie_id, started_at)
values (1, 1, '2021-06-01 15:49:55'),
       (2, 2, '2021-06-01 16:57:22'),
       (1, 3, '2021-06-01 11:58:01'),
       (2, 3, '2021-06-01 11:58:01'),
       (1, 1, '2021-06-01 11:58:01');



create table orders
(
    id        bigint unsigned auto_increment
        primary key,
    seance_id bigint unsigned not null,
    fio       varchar(255)    not null comment 'Имя покупателя',
    create_at datetime        not null,
    constraint orders_seance_id_foreign
        foreign key (seance_id) references seances (id)
            on delete cascade
) collate = utf8mb4_unicode_ci;

INSERT INTO orders(seance_id, fio, create_at)
values (1, 'Иван Плюшкин', '2021-06-01 15:50:16'),
       (3, 'Петр Иванов', '2021-06-01 16:03:11'),
       (2, 'Алексей Петров', '2021-06-01 16:03:55'),
       (5, 'Валентин Васильев', '2021-06-01 16:04:30'),
       (1, 'Евгений Сустов', '2021-06-01 16:03:55'),
       (2, 'Петр Иванов', '2021-06-01 16:04:30'),
       (5, 'Иван Плюшкин', '2021-06-01 15:50:16'),
       (4, 'Петр Иванов', '2021-06-01 16:03:11');

create table places
(
    id       bigint unsigned auto_increment
        primary key,
    p_row    int             not null,
    p_number int             not null,
    coef     int             not null,
    hall_id  bigint unsigned not null,
    constraint places_hall_id_foreign
        foreign key (hall_id) references halls (id)
            on delete cascade
) collate = utf8mb4_unicode_ci;


INSERT INTO places(p_row, p_number, coef, hall_id)
values (1, 1, 1, 1),
       (1, 2, 1, 1),
       (2, 1, 1, 1),
       (2, 2, 1, 1),
       (3, 1, 1, 1),
       (3, 2, 1, 1),
       (4, 1, 1, 1),
       (1, 1, 1, 2),
       (1, 2, 1, 2),
       (2, 1, 1, 2),
       (2, 2, 1, 2),
       (3, 1, 1, 2),
       (3, 2, 1, 2),
       (4, 1, 1, 2);


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
values (1, 15, 100),
       (1, 16, 100),
       (2, 17, 150),
       (2, 18, 150),
       (3, 19, 150),
       (3, 20, 150),
       (4, 21, 250),
       (4, 22, 100),
       (5, 23, 100),
       (5, 24, 150),
       (6, 25, 150),
       (6, 26, 150),
       (7, 27, 150),
       (7, 28, 250);
