3. Выручка за месяц по определенному фильму

explain select sum(price) FROM sales sa
    LEFT JOIN sessions se ON se.id = sa.session_id
    WHERE date_part('year', date) = 2010 AND date_part('month', date) = 1 AND film_id = 5161;

Aggregate  (cost=1124.08..1124.09 rows=1 width=32)
  ->  Nested Loop  (cost=11.45..1123.55 rows=211 width=5)
        ->  Bitmap Heap Scan on sessions se  (cost=11.02..15.04 rows=1 width=4)
              Recheck Cond: ((date_part('month'::text, (date)::timestamp without time zone) = '1'::double precision) AND (date_part('year'::text, (date)::timestamp without time zone) = '2010'::double precision))
              Filter: (film_id = 5161)
              ->  BitmapAnd  (cost=11.02..11.02 rows=1 width=0)
                    ->  Bitmap Index Scan on sessions_index_date_month  (cost=0.00..5.38 rows=146 width=0)
                          Index Cond: (date_part('month'::text, (date)::timestamp without time zone) = '1'::double precision)
                    ->  Bitmap Index Scan on sessions_index_date_year  (cost=0.00..5.38 rows=146 width=0)
                          Index Cond: (date_part('year'::text, (date)::timestamp without time zone) = '2010'::double precision)
        ->  Index Scan using sales_session_id_row_seat_key on sales sa  (cost=0.43..1105.35 rows=315 width=9)
              Index Cond: (session_id = se.id)

CREATE INDEX sessions_index_film_id ON sessions (film_id);

Aggregate  (cost=1123.00..1123.01 rows=1 width=32)
  ->  Nested Loop  (cost=10.38..1122.47 rows=211 width=5)
        ->  Bitmap Heap Scan on sessions se  (cost=9.94..13.97 rows=1 width=4)
              Recheck Cond: ((film_id = 5161) AND (date_part('month'::text, (date)::timestamp without time zone) = '1'::double precision))
              Filter: (date_part('year'::text, (date)::timestamp without time zone) = '2010'::double precision)
              ->  BitmapAnd  (cost=9.94..9.94 rows=1 width=0)
                    ->  Bitmap Index Scan on sessions_index_film_id  (cost=0.00..4.31 rows=3 width=0)
                          Index Cond: (film_id = 5161)
                    ->  Bitmap Index Scan on sessions_index_date_month  (cost=0.00..5.38 rows=146 width=0)
                          Index Cond: (date_part('month'::text, (date)::timestamp without time zone) = '1'::double precision)
        ->  Index Scan using sales_session_id_row_seat_key on sales sa  (cost=0.43..1105.35 rows=315 width=9)
              Index Cond: (session_id = se.id)

DROP INDEX sessions_index_film_id;

Выводы.
Добавление индекса sessions_index_film_id не дало прирост производительности. Индекс удален.