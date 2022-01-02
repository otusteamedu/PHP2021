CREATE TABLE "Attribute"
(
    "IdAttribute" serial NOT NULL,
    "ShowId"      bigint NOT NULL,
    "TypeId"      bigint NOT NULL,
    "ValueId"     bigint NOT NULL,
    CONSTRAINT "Attribute_pk" PRIMARY KEY ("IdAttribute")
) WITH (
      OIDS= FALSE
    );

CREATE INDEX attribute_show_index  ON "Attribute" ("ShowId");


CREATE TABLE "Shows"
(
    "IdShow" serial       NOT NULL,
    "Name"   varchar(255) NOT NULL,
    CONSTRAINT "Shows_pk" PRIMARY KEY ("IdShow")
) WITH (
      OIDS= FALSE
    );



CREATE TABLE "AttributeValue"
(
    "IdAttributeValue" serial       NOT NULL,
    "IntValue"         bigint       NULL,
    "FloatValue"       DECIMAL      NULL,
    "TextValue"        TEXT         NULL,
    "StringValue"      varchar(255) NULL,
    "BooleanValue"     BOOLEAN      NULL,
    "DateValue"        DATE         NULL,
    CONSTRAINT "AttributeValue_pk" PRIMARY KEY ("IdAttributeValue")
) WITH (
      OIDS= FALSE
    );

CREATE INDEX attributevalue_datevalue_index  ON "AttributeValue" ("DateValue");


CREATE TABLE "AttributeType"
(
    "IdType"      serial       NOT NULL,
    "Code"        varchar(16)  NOT NULL,
    "Name"        varchar(255) NOT NULL,
    "Description" varchar(255) NULL,
    "DataType"    varchar(255) NOT NULL,
    CONSTRAINT "AttributeType_pk" PRIMARY KEY ("IdType")
) WITH (
      OIDS= FALSE
    );

CREATE INDEX attributetype_code_index  ON "AttributeType" ("Code");


ALTER TABLE "Attribute"
    ADD CONSTRAINT "Attribute_fk0" FOREIGN KEY ("ShowId") REFERENCES "Shows" ("IdShow");
ALTER TABLE "Attribute"
    ADD CONSTRAINT "Attribute_fk1" FOREIGN KEY ("TypeId") REFERENCES "AttributeType" ("IdType");
ALTER TABLE "Attribute"
    ADD CONSTRAINT "Attribute_fk2" FOREIGN KEY ("ValueId") REFERENCES "AttributeValue" ("IdAttributeValue");

INSERT INTO public."AttributeType" ("IdType", "Code", "Name", "Description", "DataType")
VALUES (DEFAULT, 'reviews', 'рецензии ', 'рецензии критиков, отзыв неизвестной киноакадемии', 'text');
INSERT INTO public."AttributeType" ("IdType", "Code", "Name", "Description", "DataType")
VALUES (DEFAULT, 'premium', 'премия', 'оскар, ника', 'text');
INSERT INTO public."AttributeType" ("IdType", "Code", "Name", "Description", "DataType")
VALUES (DEFAULT, 'important_dates', 'важные даты', 'мировая премьера, премьера в РФ ', 'date');
INSERT INTO public."AttributeType" ("IdType", "Code", "Name", "Description", "DataType")
VALUES (DEFAULT, 'service_dates', 'служебные даты', 'дата начала продажи билетов, когда запускать рекламу на ТВ',
        'date');

create view "ServiceDateView"("ShowName", "TaskToDay", "TaskAdd20Day") as
SELECT s."Name"                     AS "ShowName",
       string_agg(
               CASE
                   WHEN av."DateValue" = CURRENT_DATE THEN av."TextValue"
                   ELSE NULL::text
                   END, ', '::text) AS "TaskToDay",
       string_agg(
               CASE
                   WHEN av."DateValue" = (CURRENT_DATE + '20 days'::interval day) THEN av."TextValue"
                   ELSE NULL::text
                   END, ', '::text) AS "TaskAdd20Day"
FROM "Attribute" a
         JOIN "Shows" s ON s."IdShow" = a."ShowId"
         JOIN "AttributeType" at ON at."IdType" = a."TypeId"
         JOIN "AttributeValue" av ON av."IdAttributeValue" = a."ValueId"
WHERE at."Code"::text = 'service_dates'::text
  AND (av."DateValue" = CURRENT_DATE OR av."DateValue" = (CURRENT_DATE + '20 days'::interval day))
GROUP BY s."Name";


create view "MarketingView"("ShowName", "AttributType", "AttributeValue") as
SELECT s."Name"  AS "ShowName",
       at."Name" AS "AttributType",
       case when (av."IntValue" is not null) then 'IntValue = ' || av."IntValue" || ' ' else '' end ||
       case when (av."FloatValue" is not null) then 'FloatValue = ' || av."FloatValue" || ' ' else '' end ||
       case when (av."TextValue" is not null) then 'TextValue = ' || av."TextValue" || ' ' else '' end ||
       case when (av."StringValue" is not null) then 'StringValue = ' || av."StringValue" || ' ' else '' end ||
       case when (av."BooleanValue" is not null) then 'BooleanValue = ' || av."BooleanValue" || ' ' else '' end ||
       case when (av."DateValue" is not null) then 'DateValue = ' || av."DateValue" else '' end
FROM "Attribute" a
         JOIN "Shows" s ON s."IdShow" = a."ShowId"
         JOIN "AttributeType" at ON at."IdType" = a."TypeId"
         JOIN "AttributeValue" av ON av."IdAttributeValue" = a."ValueId"
