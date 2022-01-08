CREATE TABLE "tEvents" (
    "tE_ID" serial NOT NULL,
    "tE_Type" varchar(10) NOT NULL,
    "tE_Text" text NOT NULL,
	CONSTRAINT "tE_ID" PRIMARY KEY ("tE_ID")
);

CREATE TABLE "tEventsHistory" (
    "tEH_ID" serial NOT NULL,
    "tEH_Timestamp" timestamp NOT NULL,
    "tEH_Operation" char(1) NOT NULL,
    "tEH_User" text NOT NULL,
    "tE_ID" integer,
    "tE_Type" varchar(10),
    "tE_Text" text,
	CONSTRAINT "tEH_PK" PRIMARY KEY ("tEH_ID")
);


CREATE OR REPLACE FUNCTION "fEventsHistory"()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
    BEGIN
        IF (TG_OP = 'DELETE') THEN
            INSERT INTO "tEventsHistory" SELECT nextval('"tEventsHistory_tEH_ID_seq"'::regclass), now(), 'D', user, OLD.*;
            RETURN OLD;
        ELSIF ((TG_OP = 'UPDATE')AND(OLD.* IS DISTINCT FROM NEW.*)) THEN
            INSERT INTO "tEventsHistory" SELECT nextval('"tEventsHistory_tEH_ID_seq"'::regclass), now(), 'U', user, NEW.*;
            RETURN NEW;
        ELSIF (TG_OP = 'INSERT') THEN
            INSERT INTO "tEventsHistory" SELECT nextval('"tEventsHistory_tEH_ID_seq"'::regclass), now(), 'I', user, NEW.*;
            RETURN NEW;
        END IF;
        RETURN NULL;
    END;
$function$
;

CREATE TRIGGER "trEventsHistory"
AFTER INSERT OR UPDATE OR DELETE ON "tEvents"
    FOR EACH ROW EXECUTE PROCEDURE "fEventsHistory"();
	
insert into "tEvents" ("tE_Type", "tE_Text") values ('1', '1'), ('2','22'), ('3','333');

select * from "tEvents";

select * from "tEventsHistory";

update "tEvents" set "tE_Text" = '22' where length("tE_Text") >= 1; 

select * from "tEventsHistory";

