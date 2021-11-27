BEGIN;
    -- films

    INSERT INTO "public"."films" ("id", "name")
    SELECT gs.id, random_string(10) FROM generate_series(1, 10000) as gs(id);

    -- halls

    INSERT INTO "public"."halls" ("id", "name")
    SELECT gs.id, random_string(10) FROM generate_series(1, 10000) as gs(id);

    -- hall zones

    INSERT INTO "public"."hall_zones" ("id", "hall_id", "name")
    SELECT gs.id,
     (random() * gs.id + 1)::int,
    random_string(10) FROM generate_series(1, 10000) as gs(id);

    -- sessions

    INSERT INTO "public"."sessions" ("id", "film_id", "hall_zone_id", "price", "time")
    SELECT gs.id,
     (random() * gs.id + 1)::int,
    (random() * gs.id + 1)::int,
    gs.id + random() * 10 + 1,
     '14:00'
    FROM generate_series(1, 10000) as gs(id);

    --seats

    INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
    SELECT gs.id, gs.id, 1, 1 FROM generate_series(1, 1000) as gs(id);
    INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
    SELECT gs.id, gs.id, 1, 2 FROM generate_series(1001, 2000) as gs(id);
    INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
    SELECT gs.id, gs.id, 1, 3 FROM generate_series(2001, 3000) as gs(id);
    INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
    SELECT gs.id, gs.id, 1, 4 FROM generate_series(3001, 4000) as gs(id);
    INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
    SELECT gs.id, gs.id, 1, 5 FROM generate_series(4001, 5000) as gs(id);
    INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
    SELECT gs.id, gs.id, 2, 1 FROM generate_series(5001, 6000) as gs(id);
    INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
    SELECT gs.id, gs.id, 2, 2 FROM generate_series(6001, 7000) as gs(id);
    INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
    SELECT gs.id, gs.id, 2, 3 FROM generate_series(7001, 8000) as gs(id);
    INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
    SELECT gs.id, gs.id, 2, 4 FROM generate_series(8001, 9000) as gs(id);
    INSERT INTO "public"."seats" ("id", "hall_zone_id", "row", "seat")
    SELECT gs.id, gs.id, 2, 5 FROM generate_series(9001, 10000) as gs(id);
COMMIT