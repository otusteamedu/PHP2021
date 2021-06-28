---------------------------------------------------------
-- Генератор строки
---------------------------------------------------------
Create or replace function random_string(length integer) returns text as
$$
declare
    chars text[] := '{0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z}';
    result text := '';
    i integer := 0;
begin
    if length < 0 then
        raise exception 'Given length cannot be less than 0';
    end if;
    for i in 1..length loop
        result := result || chars[1+random()*(array_length(chars, 1)-1)];
    end loop;
    return result;
end;
$$ language plpgsql;

---------------------------------------------------------
-- Принимает массив, возвращает случайный элемент оттуда
---------------------------------------------------------
CREATE OR REPLACE FUNCTION random_from_array(arr int[])
RETURNS INT AS
$$
BEGIN
    RETURN arr[1 + floor((random() * array_length(arr, 1)))::int];
END
$$ LANGUAGE 'plpgsql' STRICT;

---------------------------------------------------------
-- Вернет случайный ind от low до high
---------------------------------------------------------
CREATE OR REPLACE FUNCTION random_between(low INT ,high INT)
RETURNS INT AS
$$
begin
    RETURN floor(random()* (high-low + 1) + low);
end;
$$ language 'plpgsql' STRICT;

---------------------------------------------------------
-- Наполняет случайными данными таблицу movies
-- @length - количество строк для генерации
---------------------------------------------------------
CREATE OR REPLACE FUNCTION fill_movies(length integer)
RETURNS BOOL AS
$$
begin
    for i in 1..length loop
        INSERT INTO movies (name) VALUES (random_string(random_between(4,12)));
    end loop;
    return true;
end;
$$ LANGUAGE 'plpgsql' STRICT;

---------------------------------------------------------
-- Наполняет случайными данными таблицу movie_awards
-- @length - количество строк для генерации
---------------------------------------------------------
CREATE OR REPLACE FUNCTION fill_movie_awards(length integer)
RETURNS bool AS
$$
begin
    for i in 1..length loop
        INSERT INTO movie_awards (name) VALUES (random_string(random_between(4,12)));
    end loop;
    return true;
end;
$$ LANGUAGE 'plpgsql' STRICT;

---------------------------------------------------------
-- Наполняет случайными данными таблицу movie_attributes
-- @length - количество строк для генерации
---------------------------------------------------------
CREATE OR REPLACE FUNCTION fill_movie_attributes(length integer)
RETURNS BOOL AS
$$
DECLARE
    _arr int[];
begin
    SELECT array_agg(id) INTO _arr::INT[] FROM movie_attribute_type;
    for i in 1..length loop
        INSERT INTO movie_attributes (name, movie_attribute_type_id) VALUES (random_string(random_between(4,8)), random_from_array(_arr));
    end loop;
    return true;
end;
$$ LANGUAGE 'plpgsql' STRICT;

---------------------------------------------------------
-- Наполняет случайными данными таблицу movie_attribute_values
-- @length - количество строк для генерации
---------------------------------------------------------
CREATE OR REPLACE FUNCTION fill_movie_attribute_values(length integer)
RETURNS BOOL AS
$$
DECLARE
    _movies int[];
    _movie_awards int[];
    _movie_attributes int[];
begin
    SELECT array_agg(id) INTO _movies::INT[] FROM movies;
    SELECT array_agg(id) INTO _movie_awards::INT[] FROM movie_awards;
    SELECT array_agg(id) INTO _movie_attributes::INT[] FROM movie_attributes;

    for i in 1..length loop

        INSERT INTO movie_attribute_values
        (movie_id, movie_attribute_id,val_text,val_date, val_movie_award_id)

        SELECT
            random_from_array(_movies),
            movie_attributes.id,
            CASE WHEN movie_attribute_type.id = 3 THEN random_string(random_between(10,100)) ELSE NULL END,
            CASE WHEN movie_attribute_type.id IN (1, 10) THEN to_timestamp(random_between(1624550700,1624560700)) ELSE NULL END,
            CASE WHEN movie_attribute_type.id = 6 THEN random_from_array(_movie_awards) ELSE NULL END

        FROM movie_attributes
        JOIN movie_attribute_type ON movie_attribute_type.id = movie_attributes.movie_attribute_type_id
        WHERE movie_attributes.id = random_from_array(_movie_attributes);

    END loop;
    return TRUE;
end;
$$ LANGUAGE 'plpgsql' STRICT;



