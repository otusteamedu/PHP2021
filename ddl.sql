create table halls
(
    id   bigint unsigned auto_increment
        primary key,
    name varchar(255) not null comment 'Название зала'
)
    collate = utf8mb4_unicode_ci;

INSERT INTO halls (name)
values ('Красный зал'),
       ('Синий зал');

create table movies
(
    id             bigint unsigned auto_increment
        primary key,
    starting_price double(8, 2) not null comment 'Начальная цена',
    name           varchar(255) not null comment 'Название фильма',
    duration       time         not null comment 'Продолжительность фильма'
)
    collate = utf8mb4_unicode_ci;

INSERT INTO movies (name, starting_price, duration)
values ('1+1', 100, '01:53:00'),
       ('Начало', 120, '02:42:00'),
       ('Брат', 200, '01:40:00'),
       ('Брат2', 150, '02:07:00'),
       ('Аватар', 170, '02:42:00'),
       ('Титаник', 190, '03:30:00');

create table seances
(
    id         bigint unsigned auto_increment
        primary key,
    hall_id    bigint unsigned not null,
    movie_id   bigint unsigned not null,
    coef       float    not null,
    started_at datetime        not null,
    constraint seances_hall_id_foreign
        foreign key (hall_id) references halls (id)
            on delete cascade,
    constraint seances_movie_id_foreign
        foreign key (movie_id) references movies (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create
index seances_hall_id_index
    on seances (hall_id);

create
index seances_movie_id_index
    on seances (movie_id);

INSERT INTO seances(hall_id, movie_id, coef, started_at)
values (1, 1, 1, '2021-06-01 15:49:55'),
       (2, 2, 1, '2021-06-01 16:57:22'),
       (1, 3, 1, '2021-06-01 11:58:01'),
       (2, 3, 1, '2021-06-01 11:58:01'),
       (1, 1, 1, '2021-06-01 11:58:01');


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
)
    collate = utf8mb4_unicode_ci;

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
    coef     float             not null,
    hall_id  bigint unsigned not null,
    constraint places_hall_id_foreign
        foreign key (hall_id) references halls (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;


INSERT INTO places(p_row, p_number, coef, hall_id)
values (1, 1, 1, 1),
       (1, 2, 1, 1),
       (2, 1, 1, 1),
       (2, 2, 1, 1),
       (3, 1, 1, 1),
       (3, 2, 1, 1),
       (4, 1, 1, 1),
       (1, 1, 1, 2);


create table tickets
(
    id       bigint unsigned auto_increment
        primary key,
    order_id bigint unsigned not null,
    place_id bigint unsigned not null,
    price    double(8, 2)    not null,
    constraint tickets_order_id_foreign
        foreign key (order_id) references orders (id)
            on delete cascade,
    constraint tickets_place_id_foreign
        foreign key (place_id) references places (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create index tickets_order_id_index
    on tickets (order_id);


INSERT INTO tickets (order_id, place_id, price)
values (1, 1, 100),
       (2, 2, 200),
       (3, 3, 120),
       (4, 4, 100),
       (5, 5, 100),
       (6, 6, 120),
       (7, 7, 100),
       (8, 8, 200);



