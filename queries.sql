//Выбор всех мест в зале с id = 80
SELECT id, row, seat FROM seats
WHERE hall_id = 80;

//Выбор всех сеансов на которых показывают фильм с id 58
SELECT id, time_start, time_end, price FROM sessions
WHERE movie_id = 58;

//Выбор всех билетов приобретенных пользователем с id 1431
SELECT id, seat_id, session_id, sell_price FROM tickets
WHERE client_id = 1431;

//Выбор всех клиентов которые приобрели более 75 билетов.
SELECT clients.name
FROM tickets
JOIN clients ON clients.id = tickets.client_id
GROUP BY clients.id
HAVING COUNT(tickets.id) >= 75;

//Выбрать все проданные VIP билеты на Фильм с ID 58 и информацию о них
SELECT 
    tickets.id, 
    seat_groups.name as type, 
    halls.name as hall,
    seats.row as row,
    seats.seat as seat,
    clients.name as customer,
    tickets.sell_price as price,
    movies.name as movie
    FROM tickets
    JOIN clients ON clients.id = tickets.client_id
    JOIN sessions ON sessions.id = tickets.session_id
    JOIN movies ON movies.id = sessions.movie_id
    JOIN seats ON seats.id = tickets.seat_id
    JOIN seat_groups ON seat_groups.id = seats.seat_group_id
    JOIN halls ON halls.id = seats.hall_id
    WHERE movies.id = 58 
    AND seat_groups.id = 2;


//Посчитать общую стоимость проданных билетов на каждый фильм
SELECT movies.name, SUM(tickets.sell_price) as earnings FROM movies
    JOIN sessions ON movies.id = sessions.movie_id
    JOIN tickets ON sessions.id = tickets.session_id
    GROUP BY movies.id
    ORDER BY earnings DESC;
