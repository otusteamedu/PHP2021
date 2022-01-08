Create or replace function generate_suggestion(length_min integer, length_max integer) returns text as
$$
declare
chars_upper text[] := '{A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z}';
  chars_lower text[] := '{a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z}';
  result text := '';
  num_charts integer := 3;
  i integer := 0;
  j integer := 0;
  num_words integer := floor(random()*(length_max-length_min+1))+length_min;
begin
  if length_max < 0 OR length_min < 0 OR length_max < length_min then
    raise exception 'Params incorrect';
end if;
for i in 1..num_words loop
    num_charts := floor(random()*(15-1+1))+1;
    for j in 1..num_charts loop
            IF i = 1 and  j = 1 THEN
                result := result || chars_upper[1+random()*(array_length(chars_upper, 1)-1)];
            ELSE
                result := result || chars_lower[1+random()*(array_length(chars_lower, 1)-1)];
            END IF;
    end loop;
    IF i < num_words THEN
        result := result || ' ';
    END IF;
end loop;
return result;
end;

$$ language plpgsql;



CREATE OR REPLACE FUNCTION insert_price() RETURNS boolean
    LANGUAGE plpgsql
AS
$$
DECLARE
    -- строка из таблицы halls
hall RECORD;
    -- коэффициент для коррентировки цены для разного времени показа
    time_rite decimal := 0.1;
    -- коэффициент для коррентировки цены для секции в которой сидит зритель - чем дальше тем дешевле - каждая секция дещевле на 0.1 (10%)
    section_rite decimal := 0.1;
    -- стоимость билета в старндартном зале (коэффициент цены 1.0), в самой удаленной зоне, на самый ранний сеанс - самый дешевый билет за день во всех залах
    base_price NUMERIC := 100;
    -- время сеансов
	times time[] := '{09:00:00,11:00:00,13:00:00,15:00:00,17:00:00,19:00:00,21:00:00,23:00:00}';
    -- cчетчик для массива в котором хранится время сеансов - times
	counter_times integer := 0;
    -- cчетчик для секций по рядам на которые разделен зал
    counter_section integer := 0;
    -- cчетчик рядов
    counter_rows integer := 0;
    -- минимальный ряд секции
    row_min integer := 0;
    -- максимальный ряд секции
    row_max integer := 0;
    -- стоимость билета
    price integer := 0;
BEGIN
FOR hall IN SELECT * FROM halls LOOP
    FOR counter_times IN 1..array_length(times, 1) LOOP
    WHILE counter_rows < hall.num_rows LOOP
    row_min = counter_rows + 1;
row_max = row_min+(hall.num_rows/hall.num_section)-1;
            price = round(base_price*hall.price_ratio*(1+(counter_times-1)*time_rite)/(1+counter_section*section_rite));
            price = 5 * ((price + 4) / 5);
INSERT INTO prices (row_min, row_max, time, price, hall_id) VALUES (row_min,row_max,times[counter_times],price,hall.id);
counter_rows = row_max;
            counter_section = counter_section + 1;
END LOOP;
        counter_rows = 0;
        counter_section = 0;
END LOOP;
    counter_times = 0;
END LOOP;
RETURN TRUE;
END
$$;



CREATE OR REPLACE FUNCTION insert_sales_2009_12() RETURNS boolean
    LANGUAGE plpgsql
AS
$$
DECLARE
    -- строка из таблицы sessions
sessions_row RECORD;
    -- строка из таблицы sessions
    hall_num_row integer;
    -- строка из таблицы sessions
    hall_num_seats integer;
    -- строка из таблицы sessions
    hall_row_id integer;
    -- cчетчик рядов
    counter_rows integer := 1;
    -- cчетчик мест
    counter_seats integer := 1;
    -- минимальный ряд секции
    row_min integer := 0;
    -- максимальный ряд секции
    row_max integer := 0;
    -- стоимость билета
    price decimal := 0;
BEGIN
FOR sessions_row IN SELECT * FROM sessions WHERE date >= '2009-12-01' AND date <= '2009-12-31' LOOP
SELECT halls.id, halls.num_rows, halls.num_seats INTO STRICT hall_row_id, hall_num_row, hall_num_seats FROM halls WHERE id = sessions_row.hall_id;
WHILE counter_rows <= hall_num_row LOOP
        WHILE counter_seats <= hall_num_seats/hall_num_row LOOP
SELECT prices.price INTO STRICT price
FROM prices
WHERE prices.hall_id = hall_row_id
  AND time = sessions_row.time
  AND counter_rows >= prices.row_min
  AND counter_rows <= prices.row_max;
INSERT INTO sales (session_id, row, seat, price) VALUES (sessions_row.id,counter_rows,counter_seats,price);
--             INSERT INTO sales (session_id, row, seat) VALUES (sessions_row.id,counter_rows,counter_seats);
counter_seats = counter_seats + 1;
END LOOP;
        counter_seats = 1;
        counter_rows = counter_rows + 1;
END LOOP;
    counter_rows = 1;
END LOOP;
RETURN TRUE;
END
$$;



CREATE OR REPLACE FUNCTION insert_sales_2010() RETURNS boolean
    LANGUAGE plpgsql
AS
$$
DECLARE
    -- строка из таблицы sessions
sessions_row RECORD;
    -- строка из таблицы sessions
    hall_num_row integer;
    -- строка из таблицы sessions
    hall_num_seats integer;
    -- строка из таблицы sessions
    hall_row_id integer;
    -- cчетчик рядов
    counter_rows integer := 1;
    -- cчетчик мест
    counter_seats integer := 1;
    -- минимальный ряд секции
    row_min integer := 0;
    -- максимальный ряд секции
    row_max integer := 0;
    -- стоимость билета
    price decimal := 0;
BEGIN
FOR sessions_row IN SELECT * FROM sessions WHERE date >= '2010-01-01' AND date <= '2010-12-31' LOOP
SELECT halls.id, halls.num_rows, halls.num_seats INTO STRICT hall_row_id, hall_num_row, hall_num_seats FROM halls WHERE id = sessions_row.hall_id;
WHILE counter_rows <= hall_num_row LOOP
        WHILE counter_seats <= hall_num_seats/hall_num_row LOOP
SELECT prices.price INTO STRICT price
FROM prices
WHERE prices.hall_id = hall_row_id
  AND time = sessions_row.time
  AND counter_rows >= prices.row_min
  AND counter_rows <= prices.row_max;
INSERT INTO sales (session_id, row, seat, price) VALUES (sessions_row.id,counter_rows,counter_seats,price);
--             INSERT INTO sales (session_id, row, seat) VALUES (sessions_row.id,counter_rows,counter_seats);
counter_seats = counter_seats + 1;
END LOOP;
        counter_seats = 1;
        counter_rows = counter_rows + 1;
END LOOP;
    counter_rows = 1;
END LOOP;
RETURN TRUE;
END
$$;




CREATE OR REPLACE FUNCTION insert_sessions_2009_12() RETURNS boolean
    LANGUAGE plpgsql
AS
$$
DECLARE
    -- строка из таблицы halls
hall RECORD;
    -- время сеансов
	times time[] := '{09:00:00,11:00:00,13:00:00,15:00:00,17:00:00,19:00:00,21:00:00,23:00:00}';
    -- cчетчик для массива в котором хранится время сеансов - times
	counter_times integer := 0;
    -- cчетчик дат
	counter_date date := '2009-12-01';
BEGIN
WHILE counter_date <= '2009-12-31' LOOP
    FOR hall IN SELECT * FROM halls LOOP
    FOR counter_times IN 1..array_length(times, 1) LOOP
                INSERT INTO sessions (hall_id, film_id, date, time) VALUES (hall.id,(floor(random()*(10000-1+1))+1),counter_date, times[counter_times]);
END LOOP;
        counter_times = 0;
END LOOP;
    counter_date = counter_date + interval '1 day';
END LOOP;
RETURN TRUE;
END
$$;




CREATE OR REPLACE FUNCTION insert_sessions_2010() RETURNS boolean
    LANGUAGE plpgsql
AS
$$
DECLARE
    -- строка из таблицы halls
hall RECORD;
    -- время сеансов
	times time[] := '{09:00:00,11:00:00,13:00:00,15:00:00,17:00:00,19:00:00,21:00:00,23:00:00}';
    -- cчетчик для массива в котором хранится время сеансов - times
	counter_times integer := 0;
    -- cчетчик дат
	counter_date date := '2010-01-01';
BEGIN
WHILE counter_date <= '2010-12-31' LOOP
    FOR hall IN SELECT * FROM halls LOOP
    FOR counter_times IN 1..array_length(times, 1) LOOP
                INSERT INTO sessions (hall_id, film_id, date, time) VALUES (hall.id,(floor(random()*(10000-1+1))+1),counter_date, times[counter_times]);
END LOOP;
        counter_times = 0;
END LOOP;
    counter_date = counter_date + interval '1 day';
END LOOP;
RETURN TRUE;
END
$$;