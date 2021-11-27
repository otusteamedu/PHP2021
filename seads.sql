insert into "films" ("name")

    select
        random_string.value
    from random_string(10) as random_string(value)