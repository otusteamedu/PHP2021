4. Инфориация о сеансе

explain
select s.*, h.* FROM sessions s
LEFT JOIN halls h ON s.hall_id = h.id
WHERE date = '2010-01-01'
  AND time = '09:00:00'
  AND hall_id = 1;


Nested Loop Left Join  (cost=0.43..16.48 rows=1 width=562)
  Join Filter: (s.hall_id = h.id)
  ->  Index Scan using sessions_hall_id_date_time_key on sessions s  (cost=0.29..8.31 rows=1 width=24)
        Index Cond: ((hall_id = 1) AND (date = '2010-01-01'::date) AND ("time" = '09:00:00'::time without time zone))
  ->  Index Scan using halls_pkey on halls h  (cost=0.14..8.16 rows=1 width=538)
        Index Cond: (id = 1)

CREATE INDEX sessions_index_hall_id ON sessions (hall_id);

Nested Loop Left Join  (cost=0.43..16.48 rows=1 width=562)
  Join Filter: (s.hall_id = h.id)
  ->  Index Scan using sessions_hall_id_date_time_key on sessions s  (cost=0.29..8.31 rows=1 width=24)
        Index Cond: ((hall_id = 1) AND (date = '2010-01-01'::date) AND ("time" = '09:00:00'::time without time zone))
  ->  Index Scan using halls_pkey on halls h  (cost=0.14..8.16 rows=1 width=538)
        Index Cond: (id = 1)

DROP INDEX sessions_index_hall_id;

Выводы.
Добавление индекса sessions_index_hall_id не дало прироста производительности. Индекс удален.


