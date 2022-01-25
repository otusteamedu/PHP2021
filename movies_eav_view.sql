-- Представление служебных данных (вместо NOW()::date для проверки используется конкретная дата)
CREATE OR REPLACE VIEW public.movie_tasks_view
AS
SELECT
    m.name,
    ma.name AS today_task,
    NULL    AS upcomming_task
FROM
    movie_attr_values mav
        JOIN movies m ON m.id = mav.movie_id
        JOIN movie_attrs ma ON ma.id = mav.attr_id
WHERE
    mav.value_date_s = '2021-12-01'::date
UNION
SELECT
    m.name,
    NULL    AS today_task,
    ma.name AS upcomming_task
FROM
    movie_attr_values mav
        JOIN movies m ON m.id = mav.movie_id
        JOIN movie_attrs ma ON ma.id = mav.attr_id
WHERE
    mav.value_date_s >= '2021-12-01'::date + 20;

-- Представление данных для маркетинга
CREATE OR REPLACE VIEW public.movie_marketing_view
AS
SELECT
    m.name                                                 AS movie_name,
    mat.name                                               AS attr_type,
    ma.name                                                AS attr_name,
    concat(mav.value_int::text, mav.value_float::text,
           mav.value_bool::text, mav.value_text::text,
           mav.value_date_m::text, mav.value_date_s::text) AS attr_value
FROM
    movie_attr_values mav
        JOIN movies m ON m.id = mav.movie_id
        JOIN movie_attrs ma ON ma.id = mav.attr_id
        JOIN movie_attr_types mat ON mat.id = ma.type_id;
