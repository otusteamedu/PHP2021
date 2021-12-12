/*
*Заполнение БД тестовыми данными
*/


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



/*Table film*/

INSERT INTO film 
SELECT id_film,
random_string(100) AS title_film,
random_string(255) AS description
FROM generate_series(1,100000) AS id_film;



/*Table film_attr_type*/

INSERT INTO film_attr_type 
SELECT id_type,
random_string(50) AS title_type,
random_string(255) AS description
FROM generate_series(1,100000) AS id_type;



/*
*Table film_attr
*Долгий запрос из-за выборки рандомного атрибута.
*SELECT id_type INTO id_res FROM  film_attr_type ORDER BY random() LIMIT 1;
*Поэтому идет простой рандом в диапазоне.
*
*/

CREATE OR REPLACE FUNCTION insert_filmattr(val int)
RETURNS void AS $$
	DECLARE id_res INTEGER;
	BEGIN
	FOR i in 1 .. val
	LOOP
		SELECT floor(random()*val+1) INTO id_res;
		INSERT INTO film_attr (id_attr,title_attr,type_id) VALUES (i,random_string(100),id_res);
	END LOOP;
	END;
$$ LANGUAGE plpgsql;

select insert_filmattr(100000);


/*
*Table film_attr_value
*
*/


CREATE OR REPLACE FUNCTION insert_filmattr_value(val int)
RETURNS void AS $$
	DECLARE 
	attr_res INTEGER;
	film_res INTEGER;
	sum_res INTEGER;
	day_res TIMESTAMP;
	bool_res BOOLEAN;
	BEGIN
	FOR i in 1 .. val
	LOOP
		SELECT floor(random()*val+1) INTO attr_res;
		SELECT floor(random()*val+1) INTO film_res;
		SELECT floor(random()*val+1) INTO sum_res;
		SELECT NOW()+(random()*(NOW()+'90 days'-NOW())) + '30 days' INTO day_res;
		
		IF i%2 = 1 THEN bool_res = 1;
		ELSE bool_res = 0;
		END IF;

		INSERT INTO film_attr_value (id_value,attr_id,value_date,value_text,value_num,value_bool,film_id)
		VALUES (i,attr_res,day_res,random_string(100),sum_res,bool_res,film_res);
	END LOOP;
	END;
$$ LANGUAGE plpgsql;

select insert_filmattr_value(100000);


/*
*Основные команды
*
*/


\! clear

SELECT * FROM film LIMIT 10;
SELECT * FROM film_attr LIMIT 10;
SELECT * FROM film_attr_value LIMIT 10;
SELECT * FROM film_attr_type LIMIT 10;


DELETE FROM film_attr_value;
VACUUM FULL film_attr_value;

DELETE FROM film_attr;
VACUUM FULL film_attr;

DELETE FROM film_attr_type;
VACUUM FULL film_attr_type;

DELETE FROM film;
VACUUM FULL film;