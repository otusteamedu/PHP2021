6. Фильм с максимальрой доходностью

explain
SELECT films.id, sum(sales.price), films.name FROM sales
LEFT JOIN sessions ON sessions.id = sales.session_id
LEFT JOIN films ON films.id = sessions.film_id
GROUP BY films.id ORDER BY sum(sales.price) DESC LIMIT 1;

Limit  (cost=98806.97..98806.97 rows=1 width=85)
  ->  Sort  (cost=98806.97..98831.97 rows=10000 width=85)
        Sort Key: (sum(sales.price)) DESC
        ->  Finalize HashAggregate  (cost=98631.97..98756.97 rows=10000 width=85)
              Group Key: films.id
              ->  Gather  (cost=96356.97..98481.97 rows=20000 width=85)
                    Workers Planned: 2
                    ->  Partial HashAggregate  (cost=95356.97..95481.97 rows=10000 width=85)
                          Group Key: films.id
                          ->  Hash Left Join  (cost=1359.00..82521.13 rows=2567167 width=58)
                                Hash Cond: (sessions.film_id = films.id)
                                ->  Hash Left Join  (cost=1029.00..75449.46 rows=2567167 width=9)
                                      Hash Cond: (sales.session_id = sessions.id)
                                      ->  Parallel Seq Scan on sales  (cost=0.00..67680.67 rows=2567167 width=9)
                                      ->  Hash  (cost=664.00..664.00 rows=29200 width=8)
                                            ->  Seq Scan on sessions  (cost=0.00..664.00 rows=29200 width=8)
                                ->  Hash  (cost=205.00..205.00 rows=10000 width=53)
                                      ->  Seq Scan on films  (cost=0.00..205.00 rows=10000 width=53)

Не удалось улучшить запрос.