1. Выручка за определенную дату

explain select sum(price) FROM sales sa
    LEFT JOIN sessions se ON se.id = sa.session_id
WHERE date = '2010-01-01' AND hall_id = 1;

Aggregate  (cost=394.84..394.85 rows=1 width=32)
  ->  Nested Loop  (cost=0.70..394.31 rows=211 width=5)
        ->  Index Scan using sessions_hall_id_date_time_key on sessions se  (cost=0.28..8.30 rows=1 width=4)
              Index Cond: ((hall_id = 1) AND (date = '2010-01-01'::date))
        ->  Index Scan using sales_session_id_row_seat_key on sales sa  (cost=0.42..383.82 rows=219 width=9)
              Index Cond: (session_id = se.id)

CREATE INDEX sales_index_session_id ON sales (session_id);

Aggregate  (cost=24.28..24.29 rows=1 width=32)
  ->  Nested Loop  (cost=0.70..23.75 rows=211 width=5)
        ->  Index Scan using sessions_hall_id_date_time_key on sessions se  (cost=0.28..8.30 rows=1 width=4)
              Index Cond: ((hall_id = 1) AND (date = '2010-01-01'::date))
        ->  Index Scan using sales_index_session_id on sales sa  (cost=0.42..13.25 rows=219 width=9)
              Index Cond: (session_id = se.id)

CREATE INDEX sessions_index_date ON sessions (date);

Aggregate  (cost=24.28..24.29 rows=1 width=32)
  ->  Nested Loop  (cost=0.70..23.75 rows=211 width=5)
        ->  Index Scan using sessions_index_date on sessions se  (cost=0.28..8.30 rows=1 width=4)
              Index Cond: (date = '2010-01-01'::date)
              Filter: (hall_id = 1)
        ->  Index Scan using sales_index_session_id on sales sa  (cost=0.42..13.25 rows=219 width=9)
              Index Cond: (session_id = se.id)

DROP INDEX sessions_index_date;

Выводы.
Добавление индекса sales_index_session_id дало прирост производительности с 394.85 до 24.29
Добавление индекса sessions_index_date не дало прироста производительности. Индекс удален.