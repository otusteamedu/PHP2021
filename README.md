# PHP2021

ДЗ: Проектирование БД

## Содержание

+ ddl.sql - файл c запросами для создания и заполнения таблиц тестовыми данными
+ LogicalDataModel.png - логическая модель базы данных

[comment]: <> (+ sql_request.sql - SQL для нахождения самого прибыльного фильма)

### -SQL для нахождения самого прибыльного фильма

```sql
--SQL для нахождения самого прибыльного фильма №1
SELECT seances.movie_id, movies.name, sum(ss.price) as movie_sum
from seances
         left join movies on seances.movie_id = movies.id
         left join (SELECT seance_id, SUM(t1.t_sum) as price
                    from orders
                             left join (SELECT order_id, sum(price) as t_sum
                                        FROM tickets
                                        GROUP BY order_id) as t1 ON orders.id = t1.order_id
                    group by seance_id) as ss
                   on seances.id = ss.seance_id
group by seances.movie_id
order by movie_sum desc;


--SQL для нахождения самого прибыльного фильма №2
SELECT movies.name, sum(price)
FROM tickets
         left join orders on tickets.order_id = orders.id
         left join seances on orders.seance_id = seances.id
         left join movies on seances.movie_id = movies.id
group by movies.id;
```