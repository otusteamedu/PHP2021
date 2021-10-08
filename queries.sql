--Количество сеансов за определенный период
select count(id)
from public.sessions
where start_time >= '2021-10-03 02:00:00' and start_time < '2021-10-03 03:00:00'

--Все билеты клиента с id 500
select id, id_seat, id_sessions, id_clients, final_price
from public.tickets
where id_clients = 500

--Все сеансы с фильмом id 50
select id, start_time, start_end, id_hall, id_movie, price
from public.sessions
where id_movie = 50

--Полученная сумма за определенный период времени
select sum(tickets.final_price)
from sessions
join tickets on tickets.id_sessions=sessions.id
where start_time >= '2021-10-03 00:00:00' and start_time < '2021-10-03 01:00:00'

--3 любимых места клиента  id 20004

select clients.name, seats.seat, count(seats.id) as count
from seats
join tickets on tickets.id_seat = seats.id
join clients on clients.id =  tickets.id_clients
where tickets.id_clients = 20004
group by clients.name, seats.seat
order by count desc
limit 3

--3 самых популярных фильма
select movies.name, count(tickets.id) 
from movies
join sessions on sessions.id_movie=movies.id
join tickets on tickets.id_sessions=sessions.id
group by movies.name
order by count desc
limit 3
