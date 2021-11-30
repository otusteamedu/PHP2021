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
    "int_value" int DEFAULT NULL,
    "boolean_value" BOOLEAN DEFAULT FALSE,
    "float_value" decimal(10,2) DEFAULT NULL,
    "string_value" varchar(255) DEFAULT NULL,
    "date_value" date DEFAULT NULL,
    "text_value" text DEFAULT NULL
);

ALTER TABLE "film_attribute_values" ADD FOREIGN KEY ("film_id") REFERENCES "films" ("id");
ALTER TABLE "film_attribute_values" ADD FOREIGN KEY ("film_attribute_id") REFERENCES "film_attributes" ("id");
ALTER TABLE "film_attributes" ADD FOREIGN KEY ("film_attribute_type_id") REFERENCES "film_attribute_types" ("id");