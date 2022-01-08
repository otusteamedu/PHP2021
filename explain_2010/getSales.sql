5. Продажи по конкретному сеансу

explain
select sa.*, se.* FROM sales sa
    LEFT JOIN sessions se ON se.id = sa.session_id
    WHERE date = '2010-01-01'
      AND time = '09:00:00'
      AND hall_id = 1;

Nested Loop  (cost=0.72..1116.81 rows=211 width=41)
  ->  Index Scan using sessions_hall_id_date_time_key on sessions se  (cost=0.29..8.31 rows=1 width=24)
        Index Cond: ((hall_id = 1) AND (date = '2010-01-01'::date) AND ("time" = '09:00:00'::time without time zone))
  ->  Index Scan using sales_session_id_row_seat_key on sales sa  (cost=0.43..1105.35 rows=315 width=17)
        Index Cond: (session_id = se.id)

CREATE INDEX sessions_index_time ON sessions (time);

CREATE INDEX sessions_index_date ON sessions (date);

CREATE INDEX sessions_index_hall_id ON sessions (hall_id);

Nested Loop  (cost=0.72..1116.81 rows=211 width=41)
  ->  Index Scan using sessions_hall_id_date_time_key on sessions se  (cost=0.29..8.31 rows=1 width=24)
        Index Cond: ((hall_id = 1) AND (date = '2010-01-01'::date) AND ("time" = '09:00:00'::time without time zone))
  ->  Index Scan using sales_session_id_row_seat_key on sales sa  (cost=0.43..1105.35 rows=315 width=17)
        Index Cond: (session_id = se.id)


DROP INDEX sessions_index_time, sessions_index_date, sessions_index_hall_id;

Выводы. Добавление индексов не дало прироста производительности. Индексы удалены.


