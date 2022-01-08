3. Выручка за месяц по определенному фильму

explain select sum(price) FROM sales sa
    LEFT JOIN sessions se ON se.id = sa.session_id
    WHERE date_part('year', date) = 2010 AND date_part('month', date) = 1 AND film_id = 5161;

Aggregate  (cost=28.99..29.00 rows=1 width=32)
  ->  Nested Loop  (cost=9.41..28.46 rows=211 width=5)
        ->  Bitmap Heap Scan on sessions se  (cost=8.99..13.02 rows=1 width=4)
              Recheck Cond: ((date_part('month'::text, (date)::timestamp without time zone) = '1'::double precision) AND (date_part('year'::text, (date)::timestamp without time zone) = '2010'::double precision))
              Filter: (film_id = 5161)
              ->  BitmapAnd  (cost=8.99..8.99 rows=1 width=0)
                    ->  Bitmap Index Scan on sessions_index_date_month  (cost=0.00..4.37 rows=12 width=0)
                          Index Cond: (date_part('month'::text, (date)::timestamp without time zone) = '1'::double precision)
                    ->  Bitmap Index Scan on sessions_index_date_year  (cost=0.00..4.37 rows=12 width=0)
                          Index Cond: (date_part('year'::text, (date)::timestamp without time zone) = '2010'::double precision)
        ->  Index Scan using sales_index_session_id on sales sa  (cost=0.42..13.25 rows=219 width=9)
              Index Cond: (session_id = se.id)

CREATE INDEX sessions_index_film_id ON sessions (film_id);

Aggregate  (cost=24.29..24.30 rows=1 width=32)
  ->  Nested Loop  (cost=0.70..23.76 rows=211 width=5)
        ->  Index Scan using sessions_index_film_id on sessions se  (cost=0.28..8.31 rows=1 width=4)
              Index Cond: (film_id = 5161)
              Filter: ((date_part('year'::text, (date)::timestamp without time zone) = '2010'::double precision) AND (date_part('month'::text, (date)::timestamp without time zone) = '1'::double precision))
        ->  Index Scan using sales_index_session_id on sales sa  (cost=0.42..13.25 rows=219 width=9)
              Index Cond: (session_id = se.id)

Выводы.
Добавление индекса sessions_index_film_id дало небольшой прирост производительности с 29.00 до 24.30