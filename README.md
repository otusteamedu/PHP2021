# PHP2021

ДЗ: Проектирование БД

## Содержание

+ ddl.sql - файл c запросами для создания и заполнения таблиц тестовыми данными
+ LogicalDataModel.png - логическая модель базы данных 

[comment]: <> (+ sql_request.sql - SQL для нахождения самого прибыльного фильма)

### -SQL для нахождения самого прибыльного фильма

```sql
SELECT seances.movie_id, movies.name, sum(ss.price) as movie_sum
from seances
         left join movies on seances.movie_id = movies.id
         left join (SELECT seance_id, SUM(full_price) as price from orders group by seance_id) as ss
                   on seances.id = ss.seance_id
group by seances.movie_id
order by movie_sum desc limit 1;
```