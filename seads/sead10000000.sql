-- BEGIN;
    -- films
--     INSERT INTO "public"."films" ("id", "name")
--     SELECT 1, 'Мстители';
--
--     INSERT INTO "public"."films" ("id", "name")
--     SELECT gs.id, random_string(10) FROM generate_series(2, 10000000) as gs(id);
--
--     -- halls
--
--     INSERT INTO "public"."halls" ("id", "name")
--     SELECT gs.id, random_string(10) FROM generate_series(1, 10000000) as gs(id);
--
--     -- hall zones
--
--     INSERT INTO "public"."hall_zones" ("id", "hall_id", "name")
--     SELECT gs.id,
--            (random() * gs.id + 1)::int,
--             random_string(10) FROM generate_series(1, 10000000) as gs(id);

    -- sessions

    INSERT INTO "public"."sessions" ("id", "film_id", "hall_zone_id", "price", "time")
    SELECT gs.id,
           (random() * gs.id + 1)::int,
            (random() * gs.id + 1)::int,
            (random() * 1000 + 1)::int,
           '14:00'
    FROM generate_series(1, 10000000) as gs(id);

    --seats

--     INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
--     SELECT gs.id, gs.id, 1, 1 FROM generate_series(1, 1000000) as gs(id);
--     INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
--     SELECT gs.id, gs.id, 1, 2 FROM generate_series(1000001, 2000000) as gs(id);
--     INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
--     SELECT gs.id, gs.id, 1, 3 FROM generate_series(2000001, 3000000) as gs(id);
--     INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
--     SELECT gs.id, gs.id, 1, 4 FROM generate_series(3000001, 4000000) as gs(id);
--     INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
--     SELECT gs.id, gs.id, 1, 5 FROM generate_series(4000001, 5000000) as gs(id);
--     INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
--     SELECT gs.id, gs.id, 2, 1 FROM generate_series(5000001, 6000000) as gs(id);
--     INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
--     SELECT gs.id, gs.id, 2, 2 FROM generate_series(6000001, 7000000) as gs(id);
--     INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
--     SELECT gs.id, gs.id, 2, 3 FROM generate_series(7000001, 8000000) as gs(id);
--     INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
--     SELECT gs.id, gs.id, 2, 4 FROM generate_series(8000001, 9000000) as gs(id);
--     INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
--     SELECT gs.id, gs.id, 2, 5 FROM generate_series(9000001, 10000000) as gs(id);
-- COMMIT