-- 1 запрос
-- 10 000
Sort  (cost=273.70..274.15 rows=179 width=63) (actual time=3.995..4.007 rows=180 loops=1)
   Sort Key: price
   Sort Method: quicksort  Memory: 48kB
   ->  Seq Scan on films  (cost=0.00..267.00 rows=179 width=63) (actual time=0.029..3.897 rows=180 loops=1)
         Filter: ((price > '300'::numeric) AND (duration <= 95))
         Rows Removed by Filter: 9820
 Planning Time: 0.219 ms
 Execution Time: 4.044 ms
(8 rows)
-- 100 000
 Sort  (cost=2761.45..2765.83 rows=1753 width=63) (actual time=24.834..24.967 rows=1841 loops=1)
   Sort Key: price
   Sort Method: quicksort  Memory: 282kB
   ->  Seq Scan on films  (cost=0.00..2667.00 rows=1753 width=63) (actual time=0.024..23.695 rows=1841 loops=1)
         Filter: ((price > '300'::numeric) AND (duration <= 95))
         Rows Removed by Filter: 98159
 Planning Time: 0.366 ms
 Execution Time: 25.121 ms
(8 rows)

CREATE INDEX price_index ON films (price);

Sort  (cost=2761.45..2765.83 rows=1753 width=63) (actual time=28.905..29.024 rows=1841 loops=1)
   Sort Key: price
   Sort Method: quicksort  Memory: 282kB
   ->  Seq Scan on films  (cost=0.00..2667.00 rows=1753 width=63) (actual time=0.025..27.826 rows=1841 loops=1)
         Filter: ((price > '300'::numeric) AND (duration <= 95))
         Rows Removed by Filter: 98159
 Planning Time: 0.673 ms
 Execution Time: 29.149 ms
(8 rows)

-- По результатам улучшения производительности нет


--2 запрос
-- 10 000
 Seq Scan on session  (cost=0.00..189.00 rows=2 width=20) (actual time=0.993..0.994 rows=0 loops=1)
   Filter: (films_id = 14)
   Rows Removed by Filter: 10000
 Planning Time: 0.076 ms
 Execution Time: 1.011 ms
(5 rows)

-- 100 000
 Seq Scan on session  (cost=0.00..3586.00 rows=3 width=20) (actual time=27.146..27.148 rows=0 loops=1)
   Filter: (films_id = 14)
   Rows Removed by Filter: 190000
 Planning Time: 0.229 ms
 Execution Time: 27.183 ms
(5 rows)

CREATE INDEX  ON session (films_id);

Bitmap Heap Scan on session  (cost=4.44..16.03 rows=3 width=20) (actual time=0.043..0.045 rows=0 loops=1)
   Recheck Cond: (films_id = 14)
   ->  Bitmap Index Scan on session_films_id_idx  (cost=0.00..4.44 rows=3 width=0) (actual time=0.039..0.040 rows=0 loops=1)
         Index Cond: (films_id = 14)
 Planning Time: 0.637 ms
 Execution Time: 0.081 ms
(6 rows)

-- при добавлении индеска время улучшилось

-- 3 запрос
--10 000
 Sort  (cost=695.45..711.36 rows=6362 width=36) (actual time=15.040..15.528 rows=6362 loops=1)
   Sort Key: (sum(total_price)) DESC
   Sort Method: quicksort  Memory: 491kB
   ->  HashAggregate  (cost=214.00..293.52 rows=6362 width=36) (actual time=9.109..12.504 rows=6362 loops=1)
         Group Key: session_id
         Batches: 1  Memory Usage: 2001kB
         ->  Seq Scan on tickets  (cost=0.00..164.00 rows=10000 width=9) (actual time=0.019..1.663 rows=10000 loops=1)
 Planning Time: 0.173 ms
 Execution Time: 15.962 ms
(9 rows)

-- 100 000
 Sort  (cost=13831.08..13963.12 rows=52816 width=36) (actual time=96.452..99.844 rows=62162 loops=1)
   Sort Key: (sum(total_price)) DESC
   Sort Method: external merge  Disk: 1168kB
   ->  HashAggregate  (cost=8051.25..9688.01 rows=52816 width=36) (actual time=58.427..82.471 rows=62162 loops=1)
         Group Key: session_id
         Planned Partitions: 4  Batches: 5  Memory Usage: 4273kB  Disk Usage: 3384kB
         ->  Seq Scan on tickets  (cost=0.00..1645.00 rows=100000 width=9) (actual time=0.009..8.239 rows=100000 loops=1)
 Planning Time: 0.452 ms
 Execution Time: 103.485 ms
(9 rows)

CREATE INDEX  ON tickets (session_id);

 Sort  (cost=10233.61..10365.65 rows=52816 width=36) (actual time=90.500..94.174 rows=62162 loops=1)
   Sort Key: (sum(total_price)) DESC
   Sort Method: external merge  Disk: 1168kB
   ->  GroupAggregate  (cost=0.29..6090.54 rows=52816 width=36) (actual time=0.083..72.926 rows=62162 loops=1)
         Group Key: session_id
         ->  Index Scan using tickets_session_id_idx on tickets  (cost=0.29..4930.34 rows=100000 width=9) (actual time=0.051..39.929 rows=100000 loops=1)
 Planning Time: 0.647 ms
 Execution Time: 96.724 ms
(8 rows)

-- незначительное улучшение

-- 4 запрос
-- 10 000
 Hash Join  (cost=943.50..1212.64 rows=10000 width=84) (actual time=11.684..33.266 rows=10000 loops=1)
   Hash Cond: (tickets.user_id = users.id)
   ->  Hash Join  (cost=659.50..902.38 rows=10000 width=75) (actual time=6.904..22.726 rows=10000 loops=1)
         Hash Cond: (tickets.session_id = session.id)
         ->  Hash Join  (cost=370.50..587.12 rows=10000 width=75) (actual time=3.580..14.196 rows=10000 loops=1)
               Hash Cond: (tickets.session_id = films.id)
               ->  Hash Join  (cost=28.50..218.86 rows=10000 width=21) (actual time=0.376..5.561 rows=10000 loops=1)
                     Hash Cond: (tickets.seat_id = seats.id)
                     ->  Seq Scan on tickets  (cost=0.00..164.00 rows=10000 width=17) (actual time=0.031..1.193 rows=10000 loops=1)
                     ->  Hash  (cost=16.00..16.00 rows=1000 width=12) (actual time=0.332..0.333 rows=1000 loops=1)
                           Buckets: 1024  Batches: 1  Memory Usage: 51kB
                           ->  Seq Scan on seats  (cost=0.00..16.00 rows=1000 width=12) (actual time=0.011..0.171 rows=1000 loops=1)
               ->  Hash  (cost=217.00..217.00 rows=10000 width=54) (actual time=3.192..3.193 rows=10000 loops=1)
                     Buckets: 16384  Batches: 1  Memory Usage: 995kB
                     ->  Seq Scan on films  (cost=0.00..217.00 rows=10000 width=54) (actual time=0.010..1.407 rows=10000 loops=1)
         ->  Hash  (cost=164.00..164.00 rows=10000 width=12) (actual time=3.308..3.308 rows=10000 loops=1)
               Buckets: 16384  Batches: 1  Memory Usage: 558kB
               ->  Seq Scan on session  (cost=0.00..164.00 rows=10000 width=12) (actual time=0.014..1.590 rows=10000 loops=1)
   ->  Hash  (cost=159.00..159.00 rows=10000 width=17) (actual time=4.755..4.756 rows=10000 loops=1)
         Buckets: 16384  Batches: 1  Memory Usage: 619kB
         ->  Seq Scan on users  (cost=0.00..159.00 rows=10000 width=17) (actual time=0.024..2.072 rows=10000 loops=1)
 Planning Time: 1.996 ms
 Execution Time: 34.004 ms
(23 rows)

-- 100 000
 Hash Join  (cost=14414.93..21785.38 rows=100000 width=84) (actual time=99.177..164.968 rows=100000 loops=1)
   Hash Cond: (tickets.seat_id = seats.id)
   ->  Hash Join  (cost=14386.43..21493.27 rows=100000 width=80) (actual time=98.486..155.972 rows=100000 loops=1)
         Hash Cond: (tickets.session_id = session.id)
         ->  Hash Join  (cost=3419.00..7084.51 rows=100000 width=26) (actual time=43.400..69.646 rows=100000 loops=1)
               Hash Cond: (tickets.user_id = users.id)
               ->  Seq Scan on tickets  (cost=0.00..1645.00 rows=100000 width=17) (actual time=0.009..4.907 rows=100000 loops=1)
               ->  Hash  (cost=1583.00..1583.00 rows=100000 width=17) (actual time=43.312..43.312 rows=100000 loops=1)
                     Buckets: 65536  Batches: 2  Memory Usage: 2967kB
                     ->  Seq Scan on users  (cost=0.00..1583.00 rows=100000 width=17) (actual time=0.010..15.087 rows=100000 loops=1)
         ->  Hash  (cost=8545.43..8545.43 rows=100000 width=66) (actual time=54.892..54.893 rows=100000 loops=1)
               Buckets: 65536  Batches: 4  Memory Usage: 3027kB
               ->  Merge Join  (cost=1.07..8545.43 rows=100000 width=66) (actual time=0.033..35.809 rows=100000 loops=1)
                     Merge Cond: (films.id = session.id)
                     ->  Index Scan using films_pkey on films  (cost=0.29..3776.47 rows=100000 width=54) (actual time=0.017..9.410 rows=100000 loops=1)
                     ->  Index Scan using session_pkey on session  (cost=0.42..6160.42 rows=190000 width=12) (actual time=0.012..8.274 rows=100000 loops=1)
   ->  Hash  (cost=16.00..16.00 rows=1000 width=12) (actual time=0.674..0.674 rows=1000 loops=1)
         Buckets: 1024  Batches: 1  Memory Usage: 51kB
         ->  Seq Scan on seats  (cost=0.00..16.00 rows=1000 width=12) (actual time=0.024..0.321 rows=1000 loops=1)
 Planning Time: 1.648 ms
 Execution Time: 166.971 ms
(21 rows)

CREATE INDEX  ON users (name);

Hash Join  (cost=3449.80..16733.27 rows=100000 width=84) (actual time=39.915..149.627 rows=100000 loops=1)
   Hash Cond: (tickets.seat_id = seats.id)
   ->  Hash Join  (cost=3421.30..16441.16 rows=100000 width=80) (actual time=39.369..139.252 rows=100000 loops=1)
         Hash Cond: (tickets.user_id = users.id)
         ->  Merge Join  (cost=2.30..9829.65 rows=100000 width=71) (actual time=0.064..66.913 rows=100000 loops=1)
               Merge Cond: (session.id = films.id)
               ->  Merge Join  (cost=1.64..9699.23 rows=100000 width=29) (actual time=0.033..46.576 rows=100000 loops=1)
                     Merge Cond: (tickets.session_id = session.id)
                     ->  Index Scan using tickets_session_id_idx on tickets  (cost=0.29..4930.34 rows=100000 width=17) (actual time=0.017..23.388 rows=100000 loops=1)
                     ->  Index Scan using session_pkey on session  (cost=0.42..6160.42 rows=190000 width=12) (actual time=0.011..6.414 rows=99999 loops=1)
               ->  Index Scan using films_pkey on films  (cost=0.29..3776.47 rows=100000 width=54) (actual time=0.029..6.700 rows=99999 loops=1)
         ->  Hash  (cost=1583.00..1583.00 rows=100000 width=17) (actual time=39.140..39.140 rows=100000 loops=1)
               Buckets: 65536  Batches: 2  Memory Usage: 2967kB
               ->  Seq Scan on users  (cost=0.00..1583.00 rows=100000 width=17) (actual time=0.012..13.031 rows=100000 loops=1)
   ->  Hash  (cost=16.00..16.00 rows=1000 width=12) (actual time=0.529..0.529 rows=1000 loops=1)
         Buckets: 1024  Batches: 1  Memory Usage: 51kB
         ->  Seq Scan on seats  (cost=0.00..16.00 rows=1000 width=12) (actual time=0.019..0.235 rows=1000 loops=1)
 Planning Time: 2.861 ms
 Execution Time: 151.719 ms
(19 rows)
-- незначительное улучшение

-- 5 запрос
-- 10 000
 Limit  (cost=997.80..997.83 rows=10 width=90) (actual time=25.998..26.005 rows=10 loops=1)
   ->  Sort  (cost=997.80..1003.32 rows=2207 width=90) (actual time=25.996..26.002 rows=10 loops=1)
         Sort Key: (sum(tickets.total_price)) DESC
         Sort Method: top-N heapsort  Memory: 26kB
         ->  HashAggregate  (cost=922.52..950.11 rows=2207 width=90) (actual time=24.469..25.418 rows=1656 loops=1)
               Group Key: films.name
               Batches: 1  Memory Usage: 881kB
               ->  Hash Join  (cost=631.00..847.52 rows=10000 width=55) (actual time=10.765..19.461 rows=9999 loops=1)
                     Hash Cond: (session.id = tickets.id)
                     ->  Hash Join  (cost=342.00..532.26 rows=10000 width=54) (actual time=3.926..8.941 rows=10000 loops=1)
                           Hash Cond: (session.films_id = films.id)
                           ->  Seq Scan on session  (cost=0.00..164.00 rows=10000 width=8) (actual time=0.029..1.152 rows=10000 loops=1)
                           ->  Hash  (cost=217.00..217.00 rows=10000 width=54) (actual time=3.879..3.880 rows=10000 loops=1)
                                 Buckets: 16384  Batches: 1  Memory Usage: 995kB
                                 ->  Seq Scan on films  (cost=0.00..217.00 rows=10000 width=54) (actual time=0.009..1.721 rows=10000 loops=1)
                     ->  Hash  (cost=164.00..164.00 rows=10000 width=9) (actual time=6.820..6.821 rows=10000 loops=1)
                           Buckets: 16384  Batches: 1  Memory Usage: 558kB
                           ->  Seq Scan on tickets  (cost=0.00..164.00 rows=10000 width=9) (actual time=0.018..3.016 rows=10000 loops=1)
 Planning Time: 0.745 ms
 Execution Time: 26.129 ms
(20 rows)

-- 100 000
 Limit  (cost=12405.12..12405.15 rows=10 width=90) (actual time=93.876..94.009 rows=10 loops=1)
   ->  Sort  (cost=12405.12..12415.94 rows=4327 width=90) (actual time=93.875..94.007 rows=10 loops=1)
         Sort Key: (sum(tickets.total_price)) DESC
         Sort Method: top-N heapsort  Memory: 26kB
         ->  Finalize HashAggregate  (cost=12257.53..12311.62 rows=4327 width=90) (actual time=92.539..93.373 rows=5619 loops=1)
               Group Key: films.name
               Batches: 1  Memory Usage: 2513kB
               ->  Gather  (cost=11727.47..12214.26 rows=4327 width=90) (actual time=87.955..89.630 rows=8323 loops=1)
                     Workers Planned: 1
                     Workers Launched: 1
                     ->  Partial HashAggregate  (cost=10727.47..10781.56 rows=4327 width=90) (actual time=78.922..79.746 rows=4162 loops=2)
                           Group Key: films.name
                           Batches: 1  Memory Usage: 2001kB
                           Worker 0:  Batches: 1  Memory Usage: 2001kB
                           ->  Parallel Hash Join  (cost=7964.44..10286.29 rows=58824 width=55) (actual time=55.598..68.648 rows=50000 loops=2)
                                 Hash Cond: (films.id = session.films_id)
                                 ->  Parallel Seq Scan on films  (cost=0.00..1755.24 rows=58824 width=54) (actual time=0.006..2.149 rows=50000 loops=2)
                                 ->  Parallel Hash  (cost=7229.14..7229.14 rows=58824 width=9) (actual time=55.287..55.288 rows=50000 loops=2)
                                       Buckets: 131072  Batches: 1  Memory Usage: 5760kB
                                       ->  Merge Join  (cost=1.03..7229.14 rows=58824 width=9) (actual time=2.209..42.999 rows=50000 loops=2)
                                             Merge Cond: (session.id = tickets.id)
                                             ->  Parallel Index Scan using session_pkey on session  (cost=0.42..5378.07 rows=111765 width=8) (actual time=0.028..8.040 rows=51713 loops=2)
                                             ->  Index Scan using tickets_pkey on tickets  (cost=0.29..3288.29 rows=100000 width=9) (actual time=0.030..15.415 rows=100000 loops=2)
 Planning Time: 2.329 ms
 Execution Time: 94.287 ms
(25 rows)

 Limit  (cost=12405.12..12405.15 rows=10 width=90) (actual time=89.785..90.916 rows=10 loops=1)
   ->  Sort  (cost=12405.12..12415.94 rows=4327 width=90) (actual time=89.783..90.913 rows=10 loops=1)
         Sort Key: (sum(tickets.total_price)) DESC
         Sort Method: top-N heapsort  Memory: 26kB
         ->  Finalize HashAggregate  (cost=12257.53..12311.62 rows=4327 width=90) (actual time=88.450..90.280 rows=5619 loops=1)
               Group Key: films.name
               Batches: 1  Memory Usage: 2513kB
               ->  Gather  (cost=11727.47..12214.26 rows=4327 width=90) (actual time=83.758..86.461 rows=8332 loops=1)
                     Workers Planned: 1
                     Workers Launched: 1
                     ->  Partial HashAggregate  (cost=10727.47..10781.56 rows=4327 width=90) (actual time=75.096..75.925 rows=4166 loops=2)
                           Group Key: films.name
                           Batches: 1  Memory Usage: 2001kB
                           Worker 0:  Batches: 1  Memory Usage: 2001kB
                           ->  Parallel Hash Join  (cost=7964.44..10286.29 rows=58824 width=55) (actual time=52.727..65.149 rows=50000 loops=2)
                                 Hash Cond: (films.id = session.films_id)
                                 ->  Parallel Seq Scan on films  (cost=0.00..1755.24 rows=58824 width=54) (actual time=0.006..2.097 rows=50000 loops=2)
                                 ->  Parallel Hash  (cost=7229.14..7229.14 rows=58824 width=9) (actual time=52.325..52.326 rows=50000 loops=2)
                                       Buckets: 131072  Batches: 1  Memory Usage: 5728kB
                                       ->  Merge Join  (cost=1.03..7229.14 rows=58824 width=9) (actual time=1.952..41.482 rows=50000 loops=2)
                                             Merge Cond: (session.id = tickets.id)
                                             ->  Parallel Index Scan using session_pkey on session  (cost=0.42..5378.07 rows=111765 width=8) (actual time=0.020..7.732 rows=51713 loops=2)
                                             ->  Index Scan using tickets_pkey on tickets  (cost=0.29..3288.29 rows=100000 width=9) (actual time=0.027..14.812 rows=100000 loops=2)
 Planning Time: 1.059 ms
 Execution Time: 91.105 ms
(25 rows)

-- после создания индекса наблюдается улучшение

-- 6 запрос
-- 10 000
 Sort  (cost=1313.65..1338.65 rows=10000 width=49) (actual time=23.576..24.137 rows=6335 loops=1)
   Sort Key: (sum(tickets.total_price)) DESC
   Sort Method: quicksort  Memory: 658kB
   ->  HashAggregate  (cost=524.26..649.26 rows=10000 width=49) (actual time=14.630..18.658 rows=6335 loops=1)
         Group Key: users.id
         Batches: 1  Memory Usage: 2193kB
         ->  Hash Join  (cost=284.00..474.26 rows=10000 width=22) (actual time=4.568..9.713 rows=10000 loops=1)
               Hash Cond: (tickets.user_id = users.id)
               ->  Seq Scan on tickets  (cost=0.00..164.00 rows=10000 width=9) (actual time=0.014..1.081 rows=10000 loops=1)
               ->  Hash  (cost=159.00..159.00 rows=10000 width=17) (actual time=4.537..4.539 rows=10000 loops=1)
                     Buckets: 16384  Batches: 1  Memory Usage: 608kB
                     ->  Seq Scan on users  (cost=0.00..159.00 rows=10000 width=17) (actual time=0.008..1.721 rows=10000 loops=1)
 Planning Time: 0.410 ms
 Execution Time: 24.668 ms
(14 rows)

-- 100 000

 Sort  (cost=28364.38..28614.38 rows=100000 width=49) (actual time=129.397..133.715 rows=61851 loops=1)
   Sort Key: (sum(tickets.total_price)) DESC
   Sort Method: external merge  Disk: 1952kB
   ->  GroupAggregate  (cost=9950.16..16640.06 rows=100000 width=49) (actual time=68.586..113.461 rows=61851 loops=1)
         Group Key: users.id
         ->  Merge Join  (cost=9950.16..14890.06 rows=100000 width=22) (actual time=68.571..94.354 rows=100000 loops=1)
               Merge Cond: (users.id = tickets.user_id)
               ->  Index Scan using users_pkey on users  (cost=0.29..3190.29 rows=100000 width=17) (actual time=0.010..6.573 rows=100000 loops=1)
               ->  Sort  (cost=9949.82..10199.82 rows=100000 width=9) (actual time=68.555..73.585 rows=100000 loops=1)
                     Sort Key: tickets.user_id
                     Sort Method: external sort  Disk: 2552kB
                     ->  Seq Scan on tickets  (cost=0.00..1645.00 rows=100000 width=9) (actual time=0.013..13.952 rows=100000 loops=1)
 Planning Time: 0.314 ms
 Execution Time: 137.040 ms
(14 rows)

 Sort  (cost=28364.38..28614.38 rows=100000 width=49) (actual time=132.059..136.361 rows=61851 loops=1)
   Sort Key: (sum(tickets.total_price)) DESC
   Sort Method: external merge  Disk: 1952kB
   ->  GroupAggregate  (cost=9950.16..16640.06 rows=100000 width=49) (actual time=71.741..116.199 rows=61851 loops=1)
         Group Key: users.id
         ->  Merge Join  (cost=9950.16..14890.06 rows=100000 width=22) (actual time=71.701..97.146 rows=100000 loops=1)
               Merge Cond: (users.id = tickets.user_id)
               ->  Index Scan using users_pkey on users  (cost=0.29..3190.29 rows=100000 width=17) (actual time=0.015..6.079 rows=100000 loops=1)
               ->  Sort  (cost=9949.82..10199.82 rows=100000 width=9) (actual time=71.679..76.794 rows=100000 loops=1)
                     Sort Key: tickets.user_id
                     Sort Method: external sort  Disk: 2552kB
                     ->  Seq Scan on tickets  (cost=0.00..1645.00 rows=100000 width=9) (actual time=0.018..16.325 rows=100000 loops=1)
 Planning Time: 0.423 ms
 Execution Time: 139.720 ms
(14 rows)

CREATE INDEX  ON films (name);

Sort  (cost=28364.38..28614.38 rows=100000 width=49) (actual time=130.715..135.103 rows=61851 loops=1)
   Sort Key: (sum(tickets.total_price)) DESC
   Sort Method: external merge  Disk: 1952kB
   ->  GroupAggregate  (cost=9950.16..16640.06 rows=100000 width=49) (actual time=71.314..115.065 rows=61851 loops=1)
         Group Key: users.id
         ->  Merge Join  (cost=9950.16..14890.06 rows=100000 width=22) (actual time=71.301..96.353 rows=100000 loops=1)
               Merge Cond: (users.id = tickets.user_id)
               ->  Index Scan using users_pkey on users  (cost=0.29..3190.29 rows=100000 width=17) (actual time=0.015..6.017 rows=100000 loops=1)
               ->  Sort  (cost=9949.82..10199.82 rows=100000 width=9) (actual time=71.280..76.232 rows=100000 loops=1)
                     Sort Key: tickets.user_id
                     Sort Method: external sort  Disk: 2552kB
                     ->  Seq Scan on tickets  (cost=0.00..1645.00 rows=100000 width=9) (actual time=0.015..16.110 rows=100000 loops=1)
 Planning Time: 0.336 ms
 Execution Time: 138.737 ms
(14 rows)

-- незначительное улучшение после создания индекса


