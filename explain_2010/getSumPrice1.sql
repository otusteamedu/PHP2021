1. Выручка за определенную дату

explain select sum(price) FROM sales sa
    LEFT JOIN sessions se ON se.id = sa.session_id
WHERE date = '2010-01-01' AND hall_id = 1;

Aggregate  (cost=8661.23..8661.24 rows=1 width=32)
  ->  Nested Loop  (cost=4.80..8657.01 rows=1686 width=5)
        ->  Bitmap Heap Scan on sessions se  (cost=4.37..32.97 rows=8 width=4)
              Recheck Cond: ((hall_id = 1) AND (date = '2010-01-01'::date))
              ->  Bitmap Index Scan on sessions_hall_id_date_time_key  (cost=0.00..4.37 rows=8 width=0)
                    Index Cond: ((hall_id = 1) AND (date = '2010-01-01'::date))
        ->  Index Scan using sales_session_id_row_seat_key on sales sa  (cost=0.43..1074.86 rows=314 width=9)
              Index Cond: (session_id = se.id)

CREATE INDEX sales_index_session_id ON sales (session_id);

Aggregate  (cost=7661.18..7661.19 rows=1 width=32)
  ->  Nested Loop  (cost=4.80..7656.95 rows=1688 width=5)
        ->  Bitmap Heap Scan on sessions se  (cost=4.37..32.97 rows=8 width=4)
              Recheck Cond: ((hall_id = 1) AND (date = '2010-01-01'::date))
              ->  Bitmap Index Scan on sessions_hall_id_date_time_key  (cost=0.00..4.37 rows=8 width=0)
                    Index Cond: ((hall_id = 1) AND (date = '2010-01-01'::date))
        ->  Index Scan using sales_index_session_id on sales sa  (cost=0.43..949.85 rows=315 width=9)
              Index Cond: (session_id = se.id)

CREATE INDEX sessions_index_date ON sessions (date);

Aggregate  (cost=7639.09..7639.10 rows=1 width=32)
  ->  Nested Loop  (cost=0.72..7634.87 rows=1688 width=5)
        ->  Index Scan using sessions_index_date on sessions se  (cost=0.29..10.89 rows=8 width=4)
              Index Cond: (date = '2010-01-01'::date)
              Filter: (hall_id = 1)
        ->  Index Scan using sales_index_session_id on sales sa  (cost=0.43..949.85 rows=315 width=9)
              Index Cond: (session_id = se.id)

CREATE INDEX sessions_index_hall_id ON sessions (hall_id);

Aggregate  (cost=7639.09..7639.10 rows=1 width=32)
  ->  Nested Loop  (cost=0.72..7634.87 rows=1688 width=5)
        ->  Index Scan using sessions_index_date on sessions se  (cost=0.29..10.89 rows=8 width=4)
              Index Cond: (date = '2010-01-01'::date)
              Filter: (hall_id = 1)
        ->  Index Scan using sales_index_session_id on sales sa  (cost=0.43..949.85 rows=315 width=9)
              Index Cond: (session_id = se.id)


DROP INDEX sales_index_session_id;
DROP INDEX sessions_index_date;
DROP INDEX sessions_index_hall_id;

Выводы.
Добавление индекса sales_index_session_id дало небольшой прирост производительности с 8661.24 до 7661.19
Добавление индексов sessions_index_date sessions_index_hall_id не дало прироста производительности. Индексы удалены.