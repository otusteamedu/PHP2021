-- для нахождения самого прибыльного фильма
SELECT films.name, sum(sales.price) FROM sales 
LEFT JOIN sessions ON sessions.id = sales.session_id
LEFT JOIN films ON films.id = sessions.film_id
GROUP BY films.name ORDER BY sum(sales.price) DESC LIMIT 1;