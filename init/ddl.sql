CREATE TABLE "customers" (
                             "id" SERIAL PRIMARY KEY,
                             "name" varchar,
                             "phone" varchar,
                             "email" varchar
);

CREATE TABLE "halls" (
                         "id" SERIAL PRIMARY KEY,
                         "name" varchar
);

CREATE TABLE "seats" (
                         "id" SERIAL PRIMARY KEY,
                         "hall_id" int NOT NULL,
                         "row" int NOT NULL,
                         "counts" int NOT NULL,
                         "type" varchar
);

CREATE TABLE "films" (
                         "id" SERIAL PRIMARY KEY,
                         "name" varchar NOT NULL,
                         "type" varchar NOT NULL,
                         "description" varchar NOT NULL,
                         "duration" int NOT NULL
);

CREATE TABLE "session_types" (
                                 "id" SERIAL PRIMARY KEY,
                                 "name" varchar NOT NULL
);

CREATE TABLE "sessions" (
                            "id" SERIAL PRIMARY KEY,
                            "film_id" int NOT NULL,
                            "hall_id" int NOT NULL,
                            "session_type_id" int NOT NULL,
                            "start_date" timestamp
);

CREATE TABLE "prices" (
                          "id" SERIAL PRIMARY KEY,
                          "film_id" int NOT NULL,
                          "seat_id" int NOT NULL,
                          "session_type_id" int NOT NULL,
                          "value" int NOT NULL
);

CREATE TABLE "orders" (
                          "id" SERIAL PRIMARY KEY,
                          "number_order" varchar NOT NULL,
                          "customer_id" int NOT NULL,
                          "session_id" int NOT NULL,
                          "seat_number" int NOT NULL,
                          "status" varchar NOT NULL,
                          "price" int NOT NULL
);

ALTER TABLE "seats" ADD FOREIGN KEY ("hall_id") REFERENCES "halls" ("id");

ALTER TABLE "sessions" ADD FOREIGN KEY ("film_id") REFERENCES "films" ("id");

ALTER TABLE "sessions" ADD FOREIGN KEY ("hall_id") REFERENCES "halls" ("id");

ALTER TABLE "sessions" ADD FOREIGN KEY ("session_type_id") REFERENCES "session_types" ("id");

ALTER TABLE "prices" ADD FOREIGN KEY ("film_id") REFERENCES "films" ("id");

ALTER TABLE "prices" ADD FOREIGN KEY ("seat_id") REFERENCES "seats" ("id");

ALTER TABLE "prices" ADD FOREIGN KEY ("session_type_id") REFERENCES "session_types" ("id");

ALTER TABLE "orders" ADD FOREIGN KEY ("customer_id") REFERENCES "customers" ("id");

ALTER TABLE "orders" ADD FOREIGN KEY ("session_id") REFERENCES "sessions" ("id");