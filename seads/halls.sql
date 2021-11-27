INSERT INTO "public"."halls" ("id", "name")
SELECT gs.id, random_string(10) FROM generate_series(1,1000) as gs(id)