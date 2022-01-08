6. Фильм с максимальрой доходностью

explain
SELECT films.id, sum(sales.price), films.name FROM sales
LEFT JOIN sessions ON sessions.id = sales.session_id
LEFT JOIN films ON films.id = sessions.film_id
GROUP BY films.id ORDER BY sum(sales.price) DESC LIMIT 1;

Limit  (cost=11600.20..11600.20 rows=1 width=85)
  ->  Sort  (cost=11600.20..11625.20 rows=10000 width=85)
        Sort Key: (sum(sales.price)) DESC
        ->  Finalize HashAggregate  (cost=11425.20..11550.20 rows=10000 width=85)
              Group Key: films.id
              ->  Gather  (cost=9150.20..11275.20 rows=20000 width=85)
                    Workers Planned: 2
                    ->  Partial HashAggregate  (cost=8150.20..8275.20 rows=10000 width=85)
                          Group Key: films.id
                          ->  Hash Left Join  (cost=400.80..7060.03 rows=218033 width=58)
                                Hash Cond: (sessions.film_id = films.id)
                                ->  Hash Left Join  (cost=71.80..6158.45 rows=218033 width=9)
                                      Hash Cond: (sales.session_id = sessions.id)
                                      ->  Parallel Seq Scan on sales  (cost=0.00..5513.33 rows=218033 width=9)
                                      ->  Hash  (cost=40.80..40.80 rows=2480 width=8)
                                            ->  Seq Scan on sessions  (cost=0.00..40.80 rows=2480 width=8)
                                ->  Hash  (cost=204.00..204.00 rows=10000 width=53)
                                      ->  Seq Scan on films  (cost=0.00..204.00 rows=10000 width=53)

Не удалось улучшить запрос.