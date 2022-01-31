
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

Create or replace function random_name() returns text as
$$
declare
name text[] := '{Иван, Игорь, Александр, Николай, Елена, Ефросинья, Яна, Ольга}';
  result text := '';
begin
result := result || name[1+random()*(array_length(name, 1)-1)];
return result;
end;
$$ language plpgsql;

Create or replace function random_film_name() returns text as
$$
declare
name text[] := '{Формалин, Дозревающий, Травматизм, Самозванец, Сероуглерод, Перевоспитать, Травмирован, Искомый, Путный}';
  result text := '';
begin
for i in 1..random() * 3 + 1 loop
result := result || name[1+random()*(array_length(name, 1)-1)];
end loop;
return result;

end;
$$ language plpgsql;

do $$
begin
for index in 1..3 loop
    INSERT INTO halls (name) VALUES (CONCAT('hall ', index));
end loop;
end;
$$;

do $$
begin
for index in 1..1000 loop
    INSERT INTO seats (halls_id, row, seat)
                VALUES (
                            trunc(random() * 3 + 1),
                           trunc(random() * 10 + 3),
                           trunc(random() * 100 + 1)
                       );
end loop;
end;
$$;

do $$
begin
for index in 1..100000 loop
                INSERT INTO users (name)
                VALUES (random_name());
end loop;
end;
$$;

do $$
begin
for index in 1..100000 loop
                INSERT INTO films (name, price, duration)
                VALUES (random_film_name(),
                        trunc(random() * 350 + 200),
                        trunc(random() * 240 + 90));
end loop;
end;
$$;

do $$
begin
for index in 1..100000 loop
                INSERT INTO session (hall_id, films_id, start_time)
                VALUES (trunc(random() * 3 + 1),
                        trunc(random() * 99999 + 1),
                        (NOW() + (random() * (NOW()+'120 days' - NOW()))));
end loop;
end;
$$;

do $$
begin
for index in 1..100000 loop
                INSERT INTO tickets (user_id, seat_id, session_id, total_price)
                VALUES (trunc(random() * 99999 + 1),
                        trunc(random() * 999 + 1),
                        trunc(random() * 99999 + 1),
                        trunc(random() * 350 + 200)
                );
end loop;
end;
$$;

do $$
begin
for index in 1..100000 loop
                INSERT INTO busy_seats (seat_id, session_id)
                VALUES (trunc(random() * 999 + 1),
                        trunc(random() * 99999 + 1)
                );
end loop;
end;
$$;