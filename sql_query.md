### SQL №1
``
SELECT * FROM orders
WHERE price>200;
``

`======== 10000 ====== ` \
Seq Scan on orders  (cost=0.00..219.00 rows=99 width=41) (actual time=0.013..3.240 rows=99 loops=1)
Filter: (price < 100)
Rows Removed by Filter: 9901
Planning Time: 0.164 ms
Execution Time: 3.277 ms

`With index` \
Index Scan using orders_price_more_200 on orders  (cost=0.14..9.88 rows=99 width=41) (actual time=0.040..0.082 rows=99 loops=1)
Index Cond: (price < 100)
Planning Time: 0.847 ms
Execution Time: 0.121 ms

`Resolve add path indexes` \
CREATE INDEX "orders_price_more_200" ON orders USING BTREE ("price") WHERE price > 200;

`====== 1 000 000 =====`
Seq Scan on orders  (cost=0.00..21846.00 rows=206490 width=43) (actual time=0.017..122.220 rows=200827 loops=1)
Filter: (price > 200)
Rows Removed by Filter: 799173
Planning Time: 0.096 ms
Execution Time: 130.865 ms


`With index` \

Bitmap Heap Scan on orders  (cost=1752.05..13679.18 rows=206490 width=43) (actual time=26.938..62.560 rows=200827 loops=1)
Recheck Cond: (price > 200)
Heap Blocks: exact=9346
->  Bitmap Index Scan on orders_price_more_200  (cost=0.00..1700.43 rows=206490 width=0) (actual time=24.118..24.118 rows=200827 loops=1)
Planning Time: 0.164 ms
Execution Time: 71.284 ms

Подходит тотже ключ


`======== 10000 ====== ` \
### SQL №2
``
    SELECT
        f.name as film_name,
        p.value
    FROM films f
        RIGHT JOIN prices p on f.id = p.film_id
        WHERE p.value > 50 and f.type='fantstik'
``
New query:
``
    SELECT
        f.name as film_name,
        p.value
    FROM films f
        RIGHT JOIN prices p on f.id = p.film_id
        WHERE p.value > 50 and f.type_id=2
``

`======== 10000 ====== ` \

Hash Join  (cost=344.00..559.13 rows=9950 width=18) (actual time=4.936..11.494 rows=9950 loops=1)
Hash Cond: (p.film_id = f.id)
->  Seq Scan on prices p  (cost=0.00..189.00 rows=9950 width=8) (actual time=0.012..2.184 rows=9950 loops=1)
Filter: (value > 50)
Rows Removed by Filter: 50
->  Hash  (cost=219.00..219.00 rows=10000 width=18) (actual time=4.881..4.883 rows=10000 loops=1)
Buckets: 16384  Batches: 1  Memory Usage: 636kB
->  Seq Scan on films f  (cost=0.00..219.00 rows=10000 width=18) (actual time=0.005..2.427 rows=10000 loops=1)
Filter: ((type)::text = 'fantstik'::text)
Planning Time: 0.169 ms
Execution Time: 11.980 ms

`Предлагаю вынести тип films в отдельную таблицу во избежания дубликатов.`

Hash Join  (cost=250.03..460.15 rows=2640 width=18) (actual time=3.502..8.401 rows=2589 loops=1)
Hash Cond: (p.film_id = f.id)
->  Seq Scan on prices p  (cost=0.00..189.00 rows=8044 width=8) (actual time=0.010..2.245 rows=8017 loops=1)
Filter: (value > 50)
Rows Removed by Filter: 1983
->  Hash  (cost=209.00..209.00 rows=3282 width=18) (actual time=3.461..3.463 rows=3282 loops=1)
Buckets: 4096  Batches: 1  Memory Usage: 199kB
->  Seq Scan on films f  (cost=0.00..209.00 rows=3282 width=18) (actual time=0.006..2.300 rows=3282 loops=1)
Filter: (type_id = 2)
Rows Removed by Filter: 6718
Planning Time: 0.268 ms
Execution Time: 8.594 ms

`============================ After index ======================`
Hash Join  (cost=207.77..417.90 rows=2640 width=18) (actual time=1.065..4.196 rows=2589 loops=1)
Hash Cond: (p.film_id = f.id)
->  Seq Scan on prices p  (cost=0.00..189.00 rows=8044 width=8) (actual time=0.004..1.350 rows=8017 loops=1)
Filter: (value > 50)
Rows Removed by Filter: 1983
->  Hash  (cost=166.75..166.75 rows=3282 width=18) (actual time=1.053..1.058 rows=3282 loops=1)
Buckets: 4096  Batches: 1  Memory Usage: 199kB
->  Bitmap Heap Scan on films f  (cost=41.72..166.75 rows=3282 width=18) (actual time=0.075..0.604 rows=3282 loops=1)
Recheck Cond: (type_id = 2)
Heap Blocks: exact=84
->  Bitmap Index Scan on film_type_id  (cost=0.00..40.90 rows=3282 width=0) (actual time=0.064..0.065 rows=3282 loops=1)
Index Cond: (type_id = 2)
Planning Time: 0.195 ms
Execution Time: 4.320 ms

После добавления финдекса 

CREATE INDEX "film_type_id" ON films USING BTREE ("type_id");

` === 1000000`
Hash Join  (cost=27871.84..57028.56 rows=266262 width=20) (actual time=163.210..612.150 rows=266495 loops=1)
Hash Cond: (p.film_id = f.id)
->  Seq Scan on prices p  (cost=0.00..18870.00 rows=797986 width=8) (actual time=0.014..183.679 rows=799214 loops=1)
Filter: (value > 50)
Rows Removed by Filter: 200786
->  Hash  (cost=21745.00..21745.00 rows=333667 width=20) (actual time=163.125..163.126 rows=333311 loops=1)
Buckets: 65536  Batches: 8  Memory Usage: 2787kB
->  Seq Scan on films f  (cost=0.00..21745.00 rows=333667 width=20) (actual time=0.016..104.346 rows=333311 loops=1)
Filter: (type_id = 2)
Rows Removed by Filter: 666689
Planning Time: 57.200 ms
Execution Time: 621.372 ms

`AFter index `

Hash Join  (cost=23265.02..52421.74 rows=266262 width=20) (actual time=146.488..546.315 rows=266495 loops=1)
Hash Cond: (p.film_id = f.id)
->  Seq Scan on prices p  (cost=0.00..18870.00 rows=797986 width=8) (actual time=0.053..133.573 rows=799214 loops=1)
Filter: (value > 50)
Rows Removed by Filter: 200786
->  Hash  (cost=17138.18..17138.18 rows=333667 width=20) (actual time=146.327..146.328 rows=333311 loops=1)
Buckets: 65536  Batches: 8  Memory Usage: 2787kB
->  Bitmap Heap Scan on films f  (cost=3722.34..17138.18 rows=333667 width=20) (actual time=28.011..85.629 rows=333311 loops=1)
Recheck Cond: (type_id = 2)
Heap Blocks: exact=9245
->  Bitmap Index Scan on film_type_id  (cost=0.00..3638.93 rows=333667 width=0) (actual time=25.406..25.407 rows=333311 loops=1)
Index Cond: (type_id = 2)
Planning Time: 0.539 ms
Execution Time: 555.516 ms

CREATE INDEX "film_type_id" ON films USING BTREE ("type_id");


### SQL №3
``
    SELECT sum(o.price), c.name FROM orders o
        RIGHT JOIN customers c on c.id = o.customer_id
        right join order_statuses os on os.id = o.order_status_id
    WHERE os.name = 'buy'
        GROUP BY c.name
        ORDER BY c.name DESC
``

`======== 10000 ====== ` \

GroupAggregate  (cost=582.86..583.68 rows=47 width=17) (actual time=30.864..34.105 rows=4011 loops=1)
Group Key: c.name
->  Sort  (cost=582.86..582.97 rows=47 width=13) (actual time=30.853..31.804 rows=5076 loops=1)
Sort Key: c.name DESC
Sort Method: quicksort  Memory: 430kB
->  Hash Right Join  (cost=334.95..581.55 rows=47 width=13) (actual time=5.607..16.138 rows=5076 loops=1)
Hash Cond: (o.order_status_id = os.id)
->  Hash Join  (cost=309.00..529.26 rows=10000 width=17) (actual time=5.590..13.799 rows=10000 loops=1)
Hash Cond: (o.customer_id = c.id)
->  Seq Scan on orders o  (cost=0.00..194.00 rows=10000 width=12) (actual time=0.003..1.155 rows=10000 loops=1)
->  Hash  (cost=184.00..184.00 rows=10000 width=13) (actual time=5.572..5.576 rows=10000 loops=1)
Buckets: 16384  Batches: 1  Memory Usage: 597kB
->  Seq Scan on customers c  (cost=0.00..184.00 rows=10000 width=13) (actual time=0.003..2.305 rows=10000 loops=1)
->  Hash  (cost=25.88..25.88 rows=6 width=4) (actual time=0.012..0.013 rows=1 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 9kB
->  Seq Scan on order_statuses os  (cost=0.00..25.88 rows=6 width=4) (actual time=0.009..0.010 rows=1 loops=1)
Filter: ((name)::text = 'buy'::text)
Rows Removed by Filter: 2
Planning Time: 0.364 ms
Execution Time: 34.471 ms

`======== after index ====== `

GroupAggregate  (cost=853.75..942.58 rows=5076 width=17) (actual time=17.078..19.353 rows=4011 loops=1)
Group Key: c.name
->  Sort  (cost=853.75..866.44 rows=5076 width=13) (actual time=17.052..17.490 rows=5076 loops=1)
Sort Key: c.name DESC
Sort Method: quicksort  Memory: 430kB
->  Hash Join  (cost=309.00..541.34 rows=5076 width=13) (actual time=2.684..5.446 rows=5076 loops=1)
Hash Cond: (o.customer_id = c.id)
->  Seq Scan on orders o  (cost=0.00..219.00 rows=5076 width=8) (actual time=0.005..1.179 rows=5076 loops=1)
Filter: (order_status_id = 1)
Rows Removed by Filter: 4924
->  Hash  (cost=184.00..184.00 rows=10000 width=13) (actual time=2.668..2.670 rows=10000 loops=1)
Buckets: 16384  Batches: 1  Memory Usage: 597kB
->  Seq Scan on customers c  (cost=0.00..184.00 rows=10000 width=13) (actual time=0.002..1.177 rows=10000 loops=1)
Planning Time: 0.244 ms
Execution Time: 19.567 ms

`===`
And search `o.order_status_id = 1 `


`1 000 000`
GroupAggregate  (cost=76287.02..76369.69 rows=4724 width=19) (actual time=2659.998..3330.902 rows=393349 loops=1)
Group Key: c.name
->  Sort  (cost=76287.02..76298.83 rows=4724 width=15) (actual time=2659.981..3146.504 rows=500069 loops=1)
Sort Key: c.name DESC
Sort Method: external merge  Disk: 12760kB
->  Hash Right Join  (cost=36744.95..75998.72 rows=4724 width=15) (actual time=296.821..1105.577 rows=500069 loops=1)
Hash Cond: (o.order_status_id = os.id)
->  Hash Join  (cost=36719.00..73339.01 rows=1000000 width=19) (actual time=296.671..977.315 rows=1000000 loops=1)
Hash Cond: (o.customer_id = c.id)
->  Seq Scan on orders o  (cost=0.00..19346.00 rows=1000000 width=12) (actual time=0.010..141.295 rows=1000000 loops=1)
->  Hash  (cost=19336.00..19336.00 rows=1000000 width=15) (actual time=296.484..296.485 rows=1000000 loops=1)
Buckets: 131072  Batches: 16  Memory Usage: 3961kB
->  Seq Scan on customers c  (cost=0.00..19336.00 rows=1000000 width=15) (actual time=0.025..118.836 rows=1000000 loops=1)
->  Hash  (cost=25.88..25.88 rows=6 width=4) (actual time=0.042..0.043 rows=1 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 9kB
->  Seq Scan on order_statuses os  (cost=0.00..25.88 rows=6 width=4) (actual time=0.034..0.037 rows=1 loops=1)
Filter: ((name)::text = 'buy'::text)
Rows Removed by Filter: 2
Planning Time: 55.865 ms
Execution Time: 3346.381 ms

`============== after added index ============`
Finalize GroupAggregate  (cost=61733.73..120505.65 rows=499567 width=19) (actual time=784.290..1328.431 rows=393349 loops=1)
Group Key: c.name
->  Gather Merge  (cost=61733.73..113428.45 rows=416306 width=19) (actual time=784.284..1200.306 rows=393349 loops=1)
Workers Planned: 2
Workers Launched: 2
->  Partial GroupAggregate  (cost=60733.71..64376.38 rows=208153 width=19) (actual time=755.583..917.372 rows=131116 loops=3)
Group Key: c.name
->  Sort  (cost=60733.71..61254.09 rows=208153 width=15) (actual time=755.565..856.277 rows=166690 loops=3)
Sort Key: c.name DESC
Sort Method: external merge  Disk: 4328kB
Worker 0:  Sort Method: external merge  Disk: 4144kB
Worker 1:  Sort Method: external merge  Disk: 4296kB
->  Parallel Hash Join  (cost=17970.25..38786.71 rows=208153 width=15) (actual time=192.124..288.418 rows=166690 loops=3)
Hash Cond: (c.id = o.customer_id)
->  Parallel Seq Scan on customers c  (cost=0.00..13502.67 rows=416667 width=15) (actual time=0.024..42.971 rows=333333 loops=3)
->  Parallel Hash  (cost=14554.33..14554.33 rows=208153 width=8) (actual time=84.044..84.045 rows=166690 loops=3)
Buckets: 131072  Batches: 8  Memory Usage: 3520kB
->  Parallel Seq Scan on orders o  (cost=0.00..14554.33 rows=208153 width=8) (actual time=8.052..53.012 rows=166690 loops=3)
Filter: (order_status_id = 1)
Rows Removed by Filter: 166644
Planning Time: 0.519 ms
JIT:
Functions: 54
"  Options: Inlining false, Optimization false, Expressions true, Deforming true"
"  Timing: Generation 3.369 ms, Inlining 0.000 ms, Optimization 1.479 ms, Emission 22.055 ms, Total 26.903 ms"
Execution Time: 1376.494 ms

Я добавил поиск не сипользуя джоин
`WHERE o.order_status_id = 1`


### SQL №4
``
    SELECT
        h.name as holl_name,
        f.name as film_name,
        to_char(s.start_date, 'DD Mon YYYY')
    FROM sessions s
        RIGHT JOIN films f on f.id = s.film_id
        RIGHT JOIN halls h on h.id = s.hall_id
        WHERE start_date
        BETWEEN current_date::TIMESTAMP
        AND current_date::TIMESTAMP + INTERVAL '1 months';
``
Hash Join  (cost=347.57..712.91 rows=3394 width=78) (actual time=10.919..28.634 rows=3397 loops=1)
Hash Cond: (s.hall_id = h.id)
->  Hash Join  (cost=309.00..656.91 rows=3394 width=26) (actual time=10.866..21.399 rows=3397 loops=1)
Hash Cond: (s.film_id = f.id)
->  Seq Scan on sessions s  (cost=0.00..339.00 rows=3394 width=16) (actual time=0.012..7.386 rows=3397 loops=1)
Filter: ((start_date >= (CURRENT_DATE)::timestamp without time zone) AND (start_date <= ((CURRENT_DATE)::timestamp without time zone + '1 mon'::interval)))
Rows Removed by Filter: 6603
->  Hash  (cost=184.00..184.00 rows=10000 width=18) (actual time=10.823..10.825 rows=10000 loops=1)
Buckets: 16384  Batches: 1  Memory Usage: 636kB
->  Seq Scan on films f  (cost=0.00..184.00 rows=10000 width=18) (actual time=0.007..4.383 rows=10000 loops=1)
->  Hash  (cost=22.70..22.70 rows=1270 width=36) (actual time=0.027..0.028 rows=7 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 17kB
->  Seq Scan on halls h  (cost=0.00..22.70 rows=1270 width=36) (actual time=0.014..0.018 rows=7 loops=1)
Planning Time: 0.679 ms
Execution Time: 29.030 ms

Hash Join  (cost=426.67..610.38 rows=3395 width=78) (actual time=8.931..17.403 rows=3397 loops=1)
Hash Cond: (s.hall_id = h.id)
->  Hash Join  (cost=388.10..554.37 rows=3395 width=26) (actual time=8.886..12.351 rows=3397 loops=1)
Hash Cond: (s.film_id = f.id)
->  Bitmap Heap Scan on sessions s  (cost=79.10..236.46 rows=3395 width=16) (actual time=0.818..1.681 rows=3397 loops=1)
Recheck Cond: ((start_date >= (CURRENT_DATE)::timestamp without time zone) AND (start_date <= ((CURRENT_DATE)::timestamp without time zone + '1 mon'::interval)))
Heap Blocks: exact=64
->  Bitmap Index Scan on sessions_start_date  (cost=0.00..78.25 rows=3395 width=0) (actual time=0.780..0.781 rows=3397 loops=1)
Index Cond: ((start_date >= (CURRENT_DATE)::timestamp without time zone) AND (start_date <= ((CURRENT_DATE)::timestamp without time zone + '1 mon'::interval)))
->  Hash  (cost=184.00..184.00 rows=10000 width=18) (actual time=8.038..8.039 rows=10000 loops=1)
Buckets: 16384  Batches: 1  Memory Usage: 636kB
->  Seq Scan on films f  (cost=0.00..184.00 rows=10000 width=18) (actual time=0.009..3.390 rows=10000 loops=1)
->  Hash  (cost=22.70..22.70 rows=1270 width=36) (actual time=0.024..0.025 rows=7 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 17kB
->  Seq Scan on halls h  (cost=0.00..22.70 rows=1270 width=36) (actual time=0.012..0.016 rows=7 loops=1)
Planning Time: 0.658 ms
Execution Time: 17.722 ms

CREATE INDEX "sessions_start_date" ON sessions USING BTREE ("start_date");

` ========= 1 000 000 ==============`

Gather  (cost=21276.60..76368.64 rows=332677 width=80) (actual time=253.856..460.726 rows=336309 loops=1)
Workers Planned: 2
Workers Launched: 2
->  Hash Join  (cost=20276.60..42100.94 rows=138615 width=80) (actual time=215.362..385.005 rows=112103 loops=3)
Hash Cond: (s.hall_id = h.id)
->  Parallel Hash Join  (cost=20238.02..41350.75 rows=138615 width=28) (actual time=215.204..306.769 rows=112103 loops=3)
Hash Cond: (f.id = s.film_id)
->  Parallel Seq Scan on films f  (cost=0.00..13411.67 rows=416667 width=20) (actual time=0.010..36.133 rows=333333 loops=3)
->  Parallel Hash  (cost=17828.33..17828.33 rows=138615 width=16) (actual time=118.769..118.770 rows=112103 loops=3)
Buckets: 131072  Batches: 8  Memory Usage: 3008kB
->  Parallel Seq Scan on sessions s  (cost=0.00..17828.33 rows=138615 width=16) (actual time=0.030..94.921 rows=112103 loops=3)
Filter: ((start_date >= (CURRENT_DATE)::timestamp without time zone) AND (start_date <= ((CURRENT_DATE)::timestamp without time zone + '1 mon'::interval)))
Rows Removed by Filter: 221230
->  Hash  (cost=22.70..22.70 rows=1270 width=36) (actual time=0.021..0.022 rows=7 loops=3)
Buckets: 2048  Batches: 1  Memory Usage: 17kB
->  Seq Scan on halls h  (cost=0.00..22.70 rows=1270 width=36) (actual time=0.014..0.016 rows=7 loops=3)
Planning Time: 0.995 ms
Execution Time: 472.871 ms

`=====================`

Hash Join  (cost=28412.06..71038.22 rows=332777 width=80) (actual time=159.648..915.138 rows=336309 loops=1)
Hash Cond: (s.hall_id = h.id)
->  Hash Join  (cost=28373.48..69291.25 rows=332777 width=28) (actual time=159.631..690.281 rows=336309 loops=1)
Hash Cond: (f.id = s.film_id)
->  Seq Scan on films f  (cost=0.00..19245.00 rows=1000000 width=20) (actual time=0.003..115.126 rows=1000000 loops=1)
->  Hash  (cost=22588.77..22588.77 rows=332777 width=16) (actual time=159.453..159.454 rows=336309 loops=1)
Buckets: 131072  Batches: 8  Memory Usage: 2989kB
->  Bitmap Heap Scan on sessions s  (cost=7067.40..22588.77 rows=332777 width=16) (actual time=31.128..102.048 rows=336309 loops=1)
Recheck Cond: ((start_date >= (CURRENT_DATE)::timestamp without time zone) AND (start_date <= ((CURRENT_DATE)::timestamp without time zone + '1 mon'::interval)))
Heap Blocks: exact=6370
->  Bitmap Index Scan on sessions_start_date  (cost=0.00..6984.21 rows=332777 width=0) (actual time=30.317..30.317 rows=336309 loops=1)
Index Cond: ((start_date >= (CURRENT_DATE)::timestamp without time zone) AND (start_date <= ((CURRENT_DATE)::timestamp without time zone + '1 mon'::interval)))
->  Hash  (cost=22.70..22.70 rows=1270 width=36) (actual time=0.008..0.009 rows=7 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 17kB
->  Seq Scan on halls h  (cost=0.00..22.70 rows=1270 width=36) (actual time=0.004..0.005 rows=7 loops=1)
Planning Time: 0.367 ms
Execution Time: 926.909 ms

CREATE INDEX "sessions_start_date" ON sessions USING BTREE ("start_date");