select o.id, m.id as 'movie_id', m.name, sum(t.price) as 'sum_price'
from `order` o
join ticket t on t.order_id=o.id
join session s on s.id = t.session_id
join movie m on m.id=s.movie_id
where o.is_paid=1
group by s.movie_id
order by sum_price desc
limit 1