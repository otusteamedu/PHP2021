BEGIN;
    -- films

    INSERT INTO "public"."films" ("id", "name")
    SELECT gs.id, random_string(10) FROM generate_series(1, 10000000  ) as gs(id);

    -- halls

    INSERT INTO "public"."halls" ("id", "name")
    SELECT gs.id, random_string(10) FROM generate_series(1, 10000000  ) as gs(id);

    -- hall zones

    INSERT INTO "public"."hall_zones" ("id", "hall_id", "name")
    SELECT gs.id,
           (random() * gs.id + 1)::int,
           random_string(10) FROM generate_series(1, 10000000  ) as gs(id);

    -- sessions

    INSERT INTO "public"."sessions" ("id", "film_id", "hall_zone_id", "price", "time")
    SELECT gs.id,
           (random() * gs.id + 1)::int,
           (random() * gs.id + 1)::int,
           gs.id + random() * 10 + 1,
           '14:00'
    FROM generate_series(1, 10000000  ) as gs(id);
COMMIT