-- 1 запрос. получение фильмов со стоимостью больше 300 и длительностью до 95 минут

SELECT * FROM films WHERE films.price > 300 AND films.duration <=95 ORDER BY price;

-- 2 запрос. Получение колличества сеансов  фильма с id =14

    SELECT * FROM session where films_id=14;

-- 3 запрос. Самые прибыльные сеансы

select session_id, sum(total_price) from tickets group by session_id order by sum  desc;

-- 4 запрос. Получение информации о билете.

SELECT users.name ,tickets.total_price, seats.row, seats.seat, films.name, session.start_time
FROM tickets, seats, films, session, users
WHERE users.id = tickets.user_id AND  seats.id = tickets.seat_id AND session.id = tickets.session_id
  AND films.id = session.id;

-- 5 запрос. Топ 10 самых прибыльных фильмов

select films.name, sum(tickets.total_price), count(films.name) as total_watch
from films inner join session on films.id=session.films_id
inner join tickets on tickets.id = session.id
group by films.name order by sum desc limit 10;

-- 6 запрос. Список покупателей по колличеству потраченных денег на билеты

select users.id, users.name, sum(tickets.total_price) from tickets
inner join users on tickets.user_id = users.id
group by users.id order by sum desc;
