INSERT INTO "public"."hall_zones" ("id", "hall_id", "name")
SELECT gs.id, (
    SELECT id FROM halls WHERE id = (gs.id - random() * 10 + 1)::int
        OR id = (gs.id + random() * 10 + 1)::int
        OR id = gs.id
        LIMIT 1
    ),
       random_string(10) FROM generate_series(1,1000) as gs(id)