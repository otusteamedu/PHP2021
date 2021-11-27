INSERT INTO "public"."sessions" ("id", "film_id", "hall_zone_id", "price", "time")
SELECT gs.id, (
    SELECT id FROM films WHERE id = (gs.id - random() * 10 + 1)::int
        OR id = (gs.id + random() * 10 + 1)::int
        OR id = gs.id
        LIMIT 1
        ),
    (
    SELECT id FROM hall_zones WHERE id = (gs.id - random() * 10 + 1)::int
            OR id = (gs.id + random() * 10 + 1)::int
            OR id = gs.id
            LIMIT 1
        ),
    gs.id + random() * 10 + 1,
    '14:00'
    FROM generate_series(1,1000) as gs(id)