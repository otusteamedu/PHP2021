create view date_event_view
as
select
     null
;

alter view date_event_view
as
select
     film.name              as film_name
    ,today.attribute_name   as today_attribute_name
    ,future.attribute_name  as future_attribute_name
  from film as f

  left join (select
                  u.film_id          as film_id
                 ,ifnull( b.name
                         ,b.code
                        )            as attribute_name

              from attribute_type        as q

              inner join attribute       as b on b.attribute_type_id = q.id
                                             and b.code = 'datetime'

              inner join attribute_value as u on u.attribute_value_id = b.id

            ) as today on today.film_id = f.id
                      and today.float_value >= cast(date() as decimal)
                      and today.float_value < cast(date(date_add(now(), interval 1 day)) as decimal)

  left join (select
                  u.film_id          as film_id
                 ,ifnull( b.name
                         ,b.code
                        )            as attribute_name

              from attribute_type        as d

              inner join attribute       as h on h.attribute_type_id = d.id
                                             and h.code = 'datetime'

              inner join attribute_value as k on k.attribute_value_id = h.id

            ) as future on future.film_id = f.id
                       and future.float_value >= cast(date(date_add(now(), interval 20 day)) as decimal)
                       and future.float_value < cast(date(date_add(now(), interval 21 day)) as decimal)
;
