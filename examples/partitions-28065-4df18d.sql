CREATE TABLE "tData" (
    "tD_ID" bigserial NOT NULL,
    "tD_Source" int2 NOT NULL,
    "tD_Type" int2 NOT NULL,
    "tD_Info" text NOT NULL,
    CONSTRAINT tmp_pk PRIMARY KEY ("tD_ID", "tD_Source")
)
PARTITION BY LIST ("tD_Source");

CREATE TABLE "tDataDefault" PARTITION OF "tData" DEFAULT;

CREATE TABLE "tData0" PARTITION OF "tData" FOR VALUES IN (0);

CREATE TABLE "tData88" PARTITION OF "tData" FOR VALUES IN (88);

insert into "tData" ("tD_Source", "tD_Type", "tD_Info") values (0, 123, 'всё в 0');
insert into "tData" ("tD_Source", "tD_Type", "tD_Info") values (88, 88, 'всё по 88');
insert into "tData" ("tD_Source", "tD_Type", "tD_Info") values (8, 8, 'всё по 8');
insert into "tData" ("tD_Source", "tD_Type", "tD_Info") values (7, 77, 'всё дёшево');

select * from "tData";

explain select * from "tData";

explain select * from "tData" where "tD_Source" = 15;

explain select * from "tData" where "tD_Source" in(0, 88);
explain select * from "tData0" where "tD_Source" in(0, 88);