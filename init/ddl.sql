CREATE TABLE "films" (
    "id" SERIAL PRIMARY KEY,
    "name" varchar
);

CREATE TABLE "film_attributes" (
    "id" SERIAL PRIMARY KEY,
    "film_attribute_type_id" int,
    "name" varchar
);

CREATE TABLE "film_attribute_types" (
    "id" SERIAL PRIMARY KEY,
    "name" varchar
);

CREATE TABLE "film_attribute_values" (
    "id" SERIAL PRIMARY KEY,
    "film_id" int,
    "film_attribute_id" int,
    "varchar_value" varchar,
    "int_value" int,
    "timestamp_value" timestamp
);

ALTER TABLE "film_attribute_values" ADD FOREIGN KEY ("film_id") REFERENCES "films" ("id");
ALTER TABLE "film_attribute_values" ADD FOREIGN KEY ("film_attribute_id") REFERENCES "film_attributes" ("id");
ALTER TABLE "film_attributes" ADD FOREIGN KEY ("film_attribute_type_id") REFERENCES "film_attribute_types" ("id");