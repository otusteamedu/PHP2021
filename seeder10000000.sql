
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


DO $$
DECLARE 
    numberOfHalls INTEGER := 1000;
    numberOfSeats INTEGER := 200000;
    numberOfMovies INTEGER := 500;
    numberOfClients INTEGER := 200000;
    numberOfSessions INTEGER := 100000;
    numberOFTickets INTEGER := 10000000;

BEGIN
    INSERT INTO halls (name)
        SELECT
            CONCAT('hall_', gs.id)
        FROM generate_series(1,numberOfHalls) as gs(id)
    ;

    INSERT INTO movies (name)
        SELECT
            CONCAT('movie_', gs.id)
        FROM generate_series(1,numberOfMovies) as gs(id)
    ;

    INSERT INTO clients (name, email, phone_number, discount)
        SELECT
            CONCAT('client_', gs.id),
            CONCAT(random_string((1 + random() * 10)::integer), '@', random_string((2 + random() * 5)::integer), '.', random_string((2 + random() * 3)::integer)),
            CONCAT('+7', floor(random() * 1000000000)::varchar),
            floor(random() * 20)::integer
        FROM generate_series(1,numberOfClients) as gs(id)
    ;

    INSERT INTO seat_groups (name, price_multiplier) VALUES
    ('normal', 1),
    ('VIP', 1.2),
    ('free', 0)
    ;

    INSERT INTO seats (hall_id, seat_group_id, row, seat)
    SELECT
        floor(1 + random() * numberOfHalls)::integer,
        floor(1 + random() * 3)::integer,
        floor(1 + random() * 15)::integer,
        floor(1 + random() * 40)::integer
        FROM generate_series(1,numberOfSeats) as gs(id)
    ;

    INSERT INTO sessions (time_start, time_end, hall_id, movie_id, price)
    SELECT
        to_timestamp(1284352323 + (gs.id * 1000)),
        to_timestamp(1284352323 + (gs.id * 1000) + 3600 + (random() * 7200)),
        floor(1 + random() * numberOfHalls)::integer,
        floor(1 + random() * numberOfMovies)::integer,
        200 + random() * 300
        FROM generate_series(1,numberOfSessions) as gs(id)
    ;

    INSERT INTO tickets (seat_id, session_id, client_id, sell_price)
    SELECT
        floor(1 + random() * numberOfSeats)::integer,
        floor(1 + random() * numberOfSessions)::integer,
        floor(1 + random() * numberOfClients)::integer,
        (200 + random() * 300)
        FROM generate_series(1,numberOFTickets) as gs(id)
    ;

END $$;