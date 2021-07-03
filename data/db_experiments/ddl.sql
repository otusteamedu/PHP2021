CREATE TABLE IF NOT EXISTS "movies" (
    "id" SERIAL,
    "name" VARCHAR NOT NULL,
    PRIMARY KEY ("id")
);

CREATE TABLE IF NOT EXISTS "movie_attributes" (
    "id" SERIAL,
    "name" VARCHAR(255) NOT NULL,
    "movie_attribute_type_id" INTEGER NOT NULL,
    PRIMARY KEY ("id"),
CONSTRAINT "FK_movie_attributes_movie_attribute_type" FOREIGN KEY ("movie_attribute_type_id") REFERENCES "public"."movie_attribute_type" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE IF NOT EXISTS "movie_attribute_type" (
    "id" SERIAL,
    "name" VARCHAR(255) NOT NULL,
    PRIMARY KEY ("id")
);

CREATE TABLE IF NOT EXISTS "movie_attribute_values" (
    "id" SERIAL,
    "movie_id" INTEGER NOT NULL,
    "movie_attribute_id" INTEGER NOT NULL,
    "val_text" TEXT NULL DEFAULT NULL,
    "val_date" TIMESTAMP NULL DEFAULT NULL,
    "val_int" INTEGER NULL DEFAULT NULL,
    "val_bool" BOOLEAN NULL DEFAULT NULL,
    "val_real" NUMERIC NULL DEFAULT NULL,
    "val_movie_award_id" INTEGER NULL DEFAULT NULL,
    PRIMARY KEY ("id"),
CONSTRAINT "FK_movie_attribute_values_movie_attributes" FOREIGN KEY ("movie_attribute_id") REFERENCES "public"."movie_attributes" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION,
CONSTRAINT "FK_movie_attribute_values_movie_awards" FOREIGN KEY ("val_movie_award_id") REFERENCES "public"."movie_awards" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION,
CONSTRAINT "FK_movie_attribute_values_movies" FOREIGN KEY ("movie_id") REFERENCES "public"."movies" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION
);


CREATE TABLE IF NOT EXISTS "movie_awards" (
    "id" SERIAL,
    "name" VARCHAR(255) NOT NULL,
    PRIMARY KEY ("id")
);
