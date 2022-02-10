/* Простые запросы

1) Фильмы с возрастным ограничением 18+ и продолжительностью менее 120 минут */

select * from film where age_limit >= 18 and duration <= 120;

--БД до 10к

Seq Scan on film  (cost=0.00..23.00 rows=105 width=28)
  Filter: ((age_limit >= 18) AND (duration <= 120))

--БД до 10кк

Seq Scan on film  (cost=0.00..31687.00 rows=132557 width=32)
  Filter: ((age_limit >= 18) AND (duration <= 120))

create index film_duration_idx on film (duration);

Bitmap Heap Scan on film  (cost=3014.83..16120.35 rows=132557 width=32)
  Recheck Cond: (duration <= 120)
  Filter: (age_limit >= 18)
  ->  Bitmap Index Scan on film_duration_idx  (cost=0.00..2981.69 rows=161235 width=0)
        Index Cond: (duration <= 120)
/*_________________________________________________________________________________
2) Билеты стоимостью от 500 рублей и датой покупки не ранее суток от текущей даты
*/
select * from ticket where price >= 500 and (purchase_timestamp - CURRENT_TIMESTAMP) < '24:00:00'::interval;

--БД до 10к

Seq Scan on ticket  (cost=0.00..28.00 rows=172 width=24)
  Filter: ((price >= '500'::numeric) AND ((purchase_timestamp - CURRENT_TIMESTAMP) < '24:00:00'::interval))

--БД до 10кк

Seq Scan on ticket  (cost=0.00..38295.00 rows=230398 width=24)
  Filter: ((price >= '500'::numeric) AND ((purchase_timestamp - CURRENT_TIMESTAMP) < '24:00:00'::interval))

/*Создание индексов для цены или времени покупки по отдельности или вместе ни к чему не привели. Имеет смысл использовать партиции по времени покупки билета (пример номер 5)
_________________________________________________________________________________
3) Сеансы за конкретный период
*/
select * from session where session_datetime >= timestamp '2021-12-01 00:00:00' and session_datetime < timestamp '2022-02-07 00:00:00'

--БД до 10кк

Gather  (cost=1000.00..18854.40 rows=1864 width=20)
  Workers Planned: 2
  ->  Parallel Seq Scan on session  (cost=0.00..17668.00 rows=777 width=20)
        Filter: ((session_datetime >= '2021-12-01 00:00:00'::timestamp without time zone) AND (session_datetime < '2022-02-07 00:00:00'::timestamp without time zone))

create index session_idx on session (session_datetime);

Bitmap Heap Scan on session  (cost=45.49..4934.84 rows=2055 width=20)
  Recheck Cond: ((session_datetime >= '2021-12-01 00:00:00'::timestamp without time zone) AND (session_datetime < '2022-02-07 00:00:00'::timestamp without time zone))
  ->  Bitmap Index Scan on session_idx  (cost=0.00..44.98 rows=2055 width=0)
        Index Cond: ((session_datetime >= '2021-12-01 00:00:00'::timestamp without time zone) AND (session_datetime < '2022-02-07 00:00:00'::timestamp without time zone))
/*
Сложные запросы
_________________________________________________________________________________
4) Поиск самого прибыльного фильма
*/
select f.name as film_name, sum(t.price) as paid_tickets_price
from public.order as o inner join public.order_to_ticket as o_to_t on o_to_t.order_id = o.order_id
inner join public.ticket as t on o_to_t.ticket_id = t.ticket_id
inner join public.session as s on t.session_id = s.session_id
inner join public.film as f on s.film_id = f.film_id
where o.status = 'PAID'
group by f.name
order by paid_tickets_price desc
limit 1;

--БД до 10к

Limit  (cost=38.22..38.23 rows=1 width=48)
  ->  Sort  (cost=38.22..38.23 rows=1 width=48)
        Sort Key: (sum(t.price)) DESC
        ->  GroupAggregate  (cost=38.19..38.21 rows=1 width=48)
              Group Key: f.name
              ->  Sort  (cost=38.19..38.19 rows=1 width=20)
                    Sort Key: f.name
                    ->  Nested Loop  (cost=19.34..38.18 rows=1 width=20)
                          ->  Nested Loop  (cost=19.06..37.83 rows=1 width=8)
                                ->  Nested Loop  (cost=18.79..37.49 rows=1 width=8)
                                      ->  Hash Join  (cost=18.51..37.15 rows=1 width=4)
                                            Hash Cond: (o_to_t.order_id = o.order_id)
                                            ->  Seq Scan on order_to_ticket o_to_t  (cost=0.00..16.00 rows=1000 width=8)
                                            ->  Hash  (cost=18.50..18.50 rows=1 width=4)
                                                  ->  Seq Scan on "order" o  (cost=0.00..18.50 rows=1 width=4)
                                                        Filter: (status = 'PAID'::order_status)
                                      ->  Index Scan using ticket_pkey on ticket t  (cost=0.28..0.34 rows=1 width=12)
                                            Index Cond: (ticket_id = o_to_t.ticket_id)
                                ->  Index Scan using session_id_pk on session s  (cost=0.28..0.34 rows=1 width=8)
                                      Index Cond: (session_id = t.session_id)
                          ->  Index Scan using film_pkey on film f  (cost=0.28..0.34 rows=1 width=20)
                                Index Cond: (film_id = s.film_id)

--БД до 10кк

Limit  (cost=41002.33..41002.34 rows=1 width=52)
  ->  Sort  (cost=41002.33..41002.34 rows=1 width=52)
        Sort Key: (sum(t.price)) DESC
        ->  Finalize GroupAggregate  (cost=41002.29..41002.32 rows=1 width=52)
              Group Key: f.name
              ->  Sort  (cost=41002.29..41002.30 rows=2 width=52)
                    Sort Key: f.name
                    ->  Gather  (cost=41002.06..41002.28 rows=2 width=52)
                          Workers Planned: 2
                          ->  Partial GroupAggregate  (cost=40002.06..40002.08 rows=1 width=52)
                                Group Key: f.name
                                ->  Sort  (cost=40002.06..40002.06 rows=1 width=24)
                                      Sort Key: f.name
                                      ->  Nested Loop  (cost=25069.30..40002.05 rows=1 width=24)
                                            ->  Nested Loop  (cost=25068.87..40001.56 rows=1 width=8)
                                                  ->  Nested Loop  (cost=25068.44..40001.08 rows=1 width=8)
                                                        ->  Hash Join  (cost=25068.01..40000.59 rows=1 width=4)
                                                              Hash Cond: (o_to_t.order_id = o.order_id)
                                                              ->  Parallel Seq Scan on order_to_ticket o_to_t  (cost=0.00..13401.33 rows=583333 width=8)
                                                              ->  Hash  (cost=25068.00..25068.00 rows=1 width=4)
                                                                    ->  Seq Scan on "order" o  (cost=0.00..25068.00 rows=1 width=4)
                                                                          Filter: (status = 'PAID'::order_status)
                                                        ->  Index Scan using ticket_pkey on ticket t  (cost=0.43..0.49 rows=1 width=12)
                                                              Index Cond: (ticket_id = o_to_t.ticket_id)
                                                  ->  Index Scan using session_id_pk on session s  (cost=0.43..0.48 rows=1 width=8)
                                                        Index Cond: (session_id = t.session_id)
                                            ->  Index Scan using film_pkey on film f  (cost=0.43..0.49 rows=1 width=24)
                                                  Index Cond: (film_id = s.film_id)

create index order_status_idx on "order" (status);

Limit  (cost=15938.64..15938.64 rows=1 width=52)
  ->  Sort  (cost=15938.64..15938.64 rows=1 width=52)
        Sort Key: (sum(t.price)) DESC
        ->  GroupAggregate  (cost=15938.60..15938.63 rows=1 width=52)
              Group Key: f.name
              ->  Sort  (cost=15938.60..15938.61 rows=1 width=24)
                    Sort Key: f.name
                    ->  Nested Loop  (cost=1005.74..15938.59 rows=1 width=24)
                          ->  Nested Loop  (cost=1005.31..15938.11 rows=1 width=8)
                                ->  Nested Loop  (cost=1004.88..15937.63 rows=1 width=8)
                                      ->  Gather  (cost=1004.46..15937.14 rows=1 width=4)
                                            Workers Planned: 2
                                            ->  Hash Join  (cost=4.46..14937.04 rows=1 width=4)
                                                  Hash Cond: (o_to_t.order_id = o.order_id)
                                                  ->  Parallel Seq Scan on order_to_ticket o_to_t  (cost=0.00..13401.33 rows=583333 width=8)
                                                  ->  Hash  (cost=4.45..4.45 rows=1 width=4)
                                                        ->  Index Scan using order_status_idx on "order" o  (cost=0.43..4.45 rows=1 width=4)
                                                              Index Cond: (status = 'PAID'::order_status)
                                      ->  Index Scan using ticket_pkey on ticket t  (cost=0.43..0.49 rows=1 width=12)
                                            Index Cond: (ticket_id = o_to_t.ticket_id)
                                ->  Index Scan using session_id_pk on session s  (cost=0.43..0.48 rows=1 width=8)
                                      Index Cond: (session_id = t.session_id)
                          ->  Index Scan using film_pkey on film f  (cost=0.43..0.49 rows=1 width=24)
                                Index Cond: (film_id = s.film_id)
/*_________________________________________________________________________________
5) Название фильма, дата и время показа и стоимость самого дорого билета на сеанс
*/
select f.name, s.session_datetime, max(t.price) from film f 
inner join "session" s on f.film_id = s.film_id 
inner join ticket t on t.session_id = s.session_id
where session_datetime < '2022-02-01 00:00:00'
group by f.name, s.session_datetime;

Finalize GroupAggregate  (cost=212955.54..382034.40 rows=1400000 width=60)
  Group Key: f.name, s.session_datetime
  ->  Gather Merge  (cost=212955.54..359284.40 rows=1166666 width=60)
        Workers Planned: 2
        ->  Partial GroupAggregate  (cost=211955.52..223622.18 rows=583333 width=60)
              Group Key: f.name, s.session_datetime
              ->  Sort  (cost=211955.52..213413.85 rows=583333 width=32)
                    Sort Key: f.name, s.session_datetime
                    ->  Hash Join  (cost=97645.00..142131.83 rows=583333 width=32)
                          Hash Cond: (s.film_id = f.film_id)
                          ->  Hash Join  (cost=47254.00..76307.58 rows=583333 width=16)
                                Hash Cond: (t.session_id = s.session_id)
                                ->  Parallel Seq Scan on ticket t  (cost=0.00..16128.33 rows=583333 width=8)
                                ->  Hash  (cost=22918.00..22918.00 rows=1400000 width=16)
                                      ->  Seq Scan on session s  (cost=0.00..22918.00 rows=1400000 width=16)
							Filter: (session_datetime < '2022-02-01 00:00:00+03'::timestamp with time zone)
                          ->  Hash  (cost=24687.00..24687.00 rows=1400000 width=24)
                                ->  Seq Scan on film f  (cost=0.00..24687.00 rows=1400000 width=24)

--Для улучшения скорости запроса в данном примере потребовалось создать партицию и перенести туда часть данных из основной таблицы

create table session_part1 () inherits (session);
alter table session_part1 add constraint partition_check check (session_datetime < '2022-03-01 00:00:00');
INSERT INTO session_part1 (session_id, cinema_hall_id, film_id, session_datetime)
SELECT session_id, cinema_hall_id, film_id, session_datetime
from session
where session_datetime < '2022-03-01 00:00:00';

GroupAggregate  (cost=52126.04..52129.52 rows=174 width=60)
  Group Key: f.name, s.session_datetime
  ->  Sort  (cost=52126.04..52126.47 rows=174 width=32)
        Sort Key: f.name, s.session_datetime
        ->  Hash Join  (cost=22572.82..52119.56 rows=174 width=32)
              Hash Cond: (t.session_id = s.session_id)
              ->  Seq Scan on ticket t  (cost=0.00..24295.00 rows=1400000 width=8)
              ->  Hash  (cost=22570.65..22570.65 rows=174 width=32)
                    ->  Gather  (cost=1000.43..22570.65 rows=174 width=32)
                          Workers Planned: 2
                          ->  Nested Loop  (cost=0.43..21553.25 rows=72 width=32)
                                ->  Append  (cost=0.00..20901.71 rows=78 width=16)
                                      ->  Parallel Seq Scan on session s  (cost=0.00..16209.67 rows=58 width=16)
                                            Filter: (session_datetime < '2022-02-01 00:00:00+03'::timestamp with time zone)
                                      ->  Parallel Seq Scan on session_part1 s_1  (cost=0.00..4692.04 rows=20 width=16)
                                            Filter: (session_datetime < '2022-02-01 00:00:00+03'::timestamp with time zone)
                                ->  Index Scan using film_pkey on film f  (cost=0.43..8.35 rows=1 width=24)
                                      Index Cond: (film_id = s.film_id)
/*_________________________________________________________________________________
6) Суммарно потраченные клиентом деньги, учитываются только оплаченные заказы
*/
select c.client_id, sum(t.price)  from client c 
join "order" o on o.client_id = c.client_id 
join order_to_ticket ott on ott.order_id = o.order_id 
join ticket t on ott.ticket_id = t.ticket_id 
where o.status = 'PAID'
group by c.client_id;

--БД до 10к

GroupAggregate  (cost=45.81..45.83 rows=1 width=36)
  Group Key: c.client_id
  ->  Sort  (cost=45.81..45.82 rows=1 width=8)
        Sort Key: c.client_id
        ->  Nested Loop  (cost=19.06..45.80 rows=1 width=8)
              ->  Nested Loop  (cost=18.79..45.46 rows=1 width=8)
                    ->  Hash Join  (cost=18.51..37.15 rows=1 width=8)
                          Hash Cond: (ott.order_id = o.order_id)
                          ->  Seq Scan on order_to_ticket ott  (cost=0.00..16.00 rows=1000 width=8)
                          ->  Hash  (cost=18.50..18.50 rows=1 width=8)
                                ->  Seq Scan on "order" o  (cost=0.00..18.50 rows=1 width=8)
                                      Filter: (status = 'PAID'::order_status)
                    ->  Index Only Scan using client_pkey on client c  (cost=0.28..8.29 rows=1 width=4)
                          Index Cond: (client_id = o.client_id)
              ->  Index Scan using ticket_pkey on ticket t  (cost=0.28..0.34 rows=1 width=8)
                    Index Cond: (ticket_id = ott.ticket_id)

--БД до 10кк

Finalize GroupAggregate  (cost=41009.77..41009.80 rows=1 width=36)
  Group Key: c.client_id
  ->  Sort  (cost=41009.77..41009.77 rows=2 width=36)
        Sort Key: c.client_id
        ->  Gather  (cost=41009.54..41009.76 rows=2 width=36)
              Workers Planned: 2
              ->  Partial GroupAggregate  (cost=40009.54..40009.56 rows=1 width=36)
                    Group Key: c.client_id
                    ->  Sort  (cost=40009.54..40009.54 rows=1 width=8)
                          Sort Key: c.client_id
                          ->  Nested Loop  (cost=25068.87..40009.53 rows=1 width=8)
                                ->  Nested Loop  (cost=25068.44..40009.04 rows=1 width=8)
                                      ->  Hash Join  (cost=25068.01..40000.59 rows=1 width=8)
                                            Hash Cond: (ott.order_id = o.order_id)
                                            ->  Parallel Seq Scan on order_to_ticket ott  (cost=0.00..13401.33 rows=583333 width=8)
                                            ->  Hash  (cost=25068.00..25068.00 rows=1 width=8)
                                                  ->  Seq Scan on "order" o  (cost=0.00..25068.00 rows=1 width=8)
                                                        Filter: (status = 'PAID'::order_status)
                                      ->  Index Only Scan using client_pkey on client c  (cost=0.43..8.45 rows=1 width=4)
                                            Index Cond: (client_id = o.client_id)
                                ->  Index Scan using ticket_pkey on ticket t  (cost=0.43..0.49 rows=1 width=8)
                                      Index Cond: (ticket_id = ott.ticket_id)
/*
В одном из предыдущих запросов (номер 4) был создан индекс статусов заказов, что по сути и привело к ускорению запроса. Ради проверки тот индекс был удален и созданы по client.id и ticket.price, но наилучший результат достигается по созданию индекса статуса заказа, так как именно статусу происходит выборка значений для дальнейшего суммирования
*/
GroupAggregate  (cost=15946.08..15946.10 rows=1 width=36)
  Group Key: c.client_id
  ->  Sort  (cost=15946.08..15946.09 rows=1 width=8)
        Sort Key: c.client_id
        ->  Nested Loop  (cost=1005.31..15946.07 rows=1 width=8)
              ->  Nested Loop  (cost=1004.88..15945.58 rows=1 width=8)
                    ->  Gather  (cost=1004.46..15937.14 rows=1 width=8)
                          Workers Planned: 2
                          ->  Hash Join  (cost=4.46..14937.04 rows=1 width=8)
                                Hash Cond: (ott.order_id = o.order_id)
                                ->  Parallel Seq Scan on order_to_ticket ott  (cost=0.00..13401.33 rows=583333 width=8)
                                ->  Hash  (cost=4.45..4.45 rows=1 width=8)
                                      ->  Index Scan using order_status_idx on "order" o  (cost=0.43..4.45 rows=1 width=8)
                                            Index Cond: (status = 'PAID'::order_status)
                    ->  Index Only Scan using client_pkey on client c  (cost=0.43..8.45 rows=1 width=4)
                          Index Cond: (client_id = o.client_id)
              ->  Index Scan using ticket_pkey on ticket t  (cost=0.43..0.49 rows=1 width=8)
                    Index Cond: (ticket_id = ott.ticket_id)
