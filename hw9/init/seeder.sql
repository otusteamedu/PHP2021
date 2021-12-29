do $$
    begin
        for index in 1..7 loop
                INSERT INTO halls (name) VALUES (CONCAT('hall_', index));
            end loop;
    end;
$$;

INSERT INTO order_statuses (name) VALUES ('buy'), ('order'), ('pre-order');
INSERT INTO film_types (name) VALUES ('funtastik'), ('funny'), ('docemunt'), ('cartoon');
INSERT INTO session_types (name) VALUES ('morning'), ('evening'), ('night');

do $$
    begin
        for index in 1..1000000 loop
                INSERT INTO customers (name, phone, email)
                VALUES (CONCAT('Jora_', index) , index, CONCAT('email_', index, '@gmail.com'));
            end loop;
    end;
$$;

do $$
    begin
        for index in 1..1000000 loop
                INSERT INTO films (name, type_id, description, duration)
                VALUES (CONCAT('Star wars ', index),   trunc(random() * 3 + 1), 'description', index);
            end loop;
    end;
$$;

do $$
    begin
        for index in 1..1000000 loop
                INSERT INTO seats (hall_id, row, counts, type)
                VALUES (
                           trunc(random() * 6 + 1),
                           1,
                           5,
                           'single'
                       );
            end loop;
    end;
$$;

do $$
    begin
        for index in 1..1000000 loop
                INSERT INTO prices (film_id, seat_id, session_type_id, value)
                VALUES (
                           trunc(random() * 999999 + 1),
                           trunc(random() * 999999 + 1),
                           trunc(random() * 2 + 1),
                           trunc(random() * 250 + 1)
                       );
            end loop;
    end;
$$;

do $$
    begin
        for index in 1..1000000 loop
                INSERT INTO sessions (film_id, hall_id, session_type_id, start_date)
                VALUES (
                           trunc(random() * 999999 + 1),
                           trunc(random() * 6 + 1),
                           trunc(random() * 2 + 1),
                           (NOW() + (random() * (NOW()+'90 days' - NOW())))
                       );
            end loop;
    end;
$$;

do $$
    begin
        for index in 1..1000000 loop
                INSERT INTO orders (number_order, customer_id, session_id, seat_number, order_status_id, price)
                VALUES (
                           CONCAT('number_order_', index),
                           trunc(random() * 999999 + 1),
                           trunc(random() * 999999 + 1),
                           index,
                           trunc(random() * 2 + 1),
                           trunc(random() * 250 + 1)
                       );
            end loop;
    end;
$$;
