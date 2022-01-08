2. Выручка за месяц

explain select sum(price) FROM sales sa
    LEFT JOIN sessions se ON se.id = sa.session_id
    WHERE date_part('year', date) = 2010 AND date_part('month', date) = 1;

Aggregate  (cost=2211.03..2211.04 rows=1 width=32)
  ->  Nested Loop  (cost=0.43..2210.50 rows=211 width=5)
        ->  Seq Scan on sessions se  (cost=0.00..1102.00 rows=1 width=4)
              Filter: ((date_part('year'::text, (date)::timestamp without time zone) = '2010'::double precision) AND (date_part('month'::text, (date)::timestamp without time zone) = '1'::double precision))
        ->  Index Scan using sales_session_id_row_seat_key on sales sa  (cost=0.43..1105.35 rows=315 width=9)
              Index Cond: (session_id = se.id)

CREATE INDEX sessions_index_date_year ON sessions (date_part('year', date));

CREATE INDEX sessions_index_date_month ON sessions (date_part('month', date));

Aggregate  (cost=1124.07..1124.08 rows=1 width=32)
  ->  Nested Loop  (cost=11.45..1123.54 rows=211 width=5)
        ->  Bitmap Heap Scan on sessions se  (cost=11.02..15.04 rows=1 width=4)
              Recheck Cond: ((date_part('month'::text, (date)::timestamp without time zone) = '1'::double precision) AND (date_part('year'::text, (date)::timestamp without time zone) = '2010'::double precision))
              ->  BitmapAnd  (cost=11.02..11.02 rows=1 width=0)
                    ->  Bitmap Index Scan on sessions_index_date_month  (cost=0.00..5.38 rows=146 width=0)
                          Index Cond: (date_part('month'::text, (date)::timestamp without time zone) = '1'::double precision)
                    ->  Bitmap Index Scan on sessions_index_date_year  (cost=0.00..5.38 rows=146 width=0)
                          Index Cond: (date_part('year'::text, (date)::timestamp without time zone) = '2010'::double precision)
        ->  Index Scan using sales_session_id_row_seat_key on sales sa  (cost=0.43..1105.35 rows=315 width=9)
              Index Cond: (session_id = se.id)

Выводы.
Добавление функциональных индексов для поиска года и месяца дало прирост произовдительности с 2211.04 по 1124.08




