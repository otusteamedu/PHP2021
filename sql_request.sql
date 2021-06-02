--SQL для нахождения самого прибыльного фильма
SELECT seances.movie_id, movies.name, sum(ss.price) as movie_sum
from seances
         left join movies on seances.movie_id = movies.id
         left join (SELECT seance_id, SUM(full_price) as price from orders group by seance_id) as ss
                   on seances.id = ss.seance_id
group by seances.movie_id
order by movie_sum desc limit 1;