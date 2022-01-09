create view property_value_view
as
select
     null
;

alter view property_value_view
as
select
     f.name         as film_name
    ,t.name         as attribute_type_name
    ,ifnull( a.name
            ,a.code
           )        as attribute_name
    ,case
       when t.code = 'string'     then ifnull(av.string_value, '')
       when t.code = 'text'       then ifnull(av.text_value, '')
       when t.code = 'bool'       then cast(ifnull(av.bool_value, '') as char)
       when t.code = 'datetime'   then date_format(ifnull(av.datetime_value, 0.00), '%Y-%m-%d %H:%i:%s')
       when t.code = 'int'        then cast(ifnull(av.int_value, '') as char)
       when t.code = 'float'      then cast(round(ifnull(av.float_value, 0.000000), 5) as char)
     end            as attribute_value

  from film as f

  inner join film_attribute_value as v on v.film_id = v.film_id

  inner join attribute            as a on a.id = v.attribute_id

  inner join attribute_type       as t on t.id = v.attribute_type_id

  inner join attribute_value      as av on av.id = v.attribute_value_id

  order by
    f.id
;
