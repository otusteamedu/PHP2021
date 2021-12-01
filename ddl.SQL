/*
Created: 29.11.2021
Modified: 01.12.2021
Model: PostgreSQL 12
Database: PostgreSQL 12
*/

-- Create tables section -------------------------------------------------

-- Table movie

CREATE TABLE "movie"
(
  "id" Serial NOT NULL,
  "name" Character varying NOT NULL
)
WITH (
  autovacuum_enabled=true)
;
COMMENT ON COLUMN "movie"."id" IS 'ID фильма'
;
COMMENT ON COLUMN "movie"."name" IS 'Название'
;

ALTER TABLE "movie" ADD CONSTRAINT "PK_movie" PRIMARY KEY ("id")
;

-- Table attribute

CREATE TABLE "attribute"
(
  "id" Serial NOT NULL,
  "name" Character varying NOT NULL,
  "attribute_type_id" Integer NOT NULL
)
WITH (
  autovacuum_enabled=true)
;
COMMENT ON COLUMN "attribute"."id" IS 'ID атрибута'
;
COMMENT ON COLUMN "attribute"."name" IS 'Название'
;
COMMENT ON COLUMN "attribute"."attribute_type_id" IS 'ID типа атрибута'
;

CREATE INDEX "ix_rel_attribute_type_by_attribute" ON "attribute" ("attribute_type_id")
;

ALTER TABLE "attribute" ADD CONSTRAINT "PK_attribute" PRIMARY KEY ("id")
;

-- Table attribute_type

CREATE TABLE "attribute_type"
(
  "id" Serial NOT NULL,
  "name" Character varying NOT NULL
)
WITH (
  autovacuum_enabled=true)
;
COMMENT ON COLUMN "attribute_type"."id" IS 'ID типа атрибута'
;
COMMENT ON COLUMN "attribute_type"."name" IS 'Название'
;

ALTER TABLE "attribute_type" ADD CONSTRAINT "PK_attribute_type" PRIMARY KEY ("id")
;

-- Table attribute_value

CREATE TABLE "attribute_value"
(
  "id" Serial NOT NULL,
  "value_int" Bigint,
  "value_text" Text,
  "value_date" Date,
  "value_bool" Boolean,
  "value_float" Double precision,
  "attribute_id" Integer NOT NULL,
  "movie_id" Integer NOT NULL
)
WITH (
  autovacuum_enabled=true)
;
COMMENT ON COLUMN "attribute_value"."id" IS 'ID значение атрибута'
;
COMMENT ON COLUMN "attribute_value"."value_int" IS 'Значение int'
;
COMMENT ON COLUMN "attribute_value"."value_text" IS 'Значение text'
;
COMMENT ON COLUMN "attribute_value"."value_date" IS 'Значение date'
;
COMMENT ON COLUMN "attribute_value"."value_bool" IS 'Значение bool'
;
COMMENT ON COLUMN "attribute_value"."value_float" IS 'Значение float'
;
COMMENT ON COLUMN "attribute_value"."attribute_id" IS 'ID атрибута'
;
COMMENT ON COLUMN "attribute_value"."movie_id" IS 'ID фильма'
;

CREATE INDEX "ix_rel_attribute_value_by_attribute" ON "attribute_value" ("attribute_id")
;

CREATE INDEX "ix_rel_attribute_by_movie" ON "attribute_value" ("movie_id")
;

ALTER TABLE "attribute_value" ADD CONSTRAINT "PK_attribute_value" PRIMARY KEY ("id")
;

-- Create foreign keys (relationships) section -------------------------------------------------

ALTER TABLE "attribute"
  ADD CONSTRAINT "rel_attribute_type_by_attribute"
    FOREIGN KEY ("attribute_type_id")
    REFERENCES "attribute_type" ("id")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
;

ALTER TABLE "attribute_value"
  ADD CONSTRAINT "rel_attribute_value_by_attribute"
    FOREIGN KEY ("attribute_id")
    REFERENCES "attribute" ("id")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
;

ALTER TABLE "attribute_value"
  ADD CONSTRAINT "rel_attribute_by_movie"
    FOREIGN KEY ("movie_id")
    REFERENCES "movie" ("id")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
;

