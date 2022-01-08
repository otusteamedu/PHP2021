CREATE OR REPLACE FUNCTION "fGetPrice"()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
    DECLARE
        sessions_time time;
        sessions_hall_id integer;
        price numeric(15,2);
    BEGIN
        IF (TG_OP = 'INSERT') THEN
            SELECT sessions.time, sessions.hall_id INTO STRICT sessions_time, sessions_hall_id FROM sessions WHERE id = NEW.session_id;
            SELECT prices.price INTO STRICT price
                FROM prices
                WHERE prices.hall_id = sessions_hall_id
                  AND time = sessions_time
                  AND NEW.row >= prices.row_min
                  AND NEW.row <= prices.row_max;
            NEW.price = price;
            RETURN NEW;
        END IF;
        RETURN NULL;
    END;
$function$
;

CREATE TRIGGER "trInsertSales"
BEFORE INSERT ON "sales"
    FOR EACH ROW EXECUTE PROCEDURE "fGetPrice"();

