INSERT INTO "public"."buyed_tickets" ("session_id", "actual_price", "seat_id")
SELECT gs.id, gs.id, 1, 1 FROM generate_series(1, 10000  ) as gs(id);
SELECT gs.id, gs.id, 1, 2 FROM generate_series(1, 10000  ) as gs(id);
SELECT gs.id, gs.id, 1, 3 FROM generate_series(1, 10000  ) as gs(id);
SELECT gs.id, gs.id, 1, 4 FROM generate_series(1, 10000  ) as gs(id);
SELECT gs.id, gs.id, 1, 5 FROM generate_series(1, 10000  ) as gs(id);
SELECT gs.id, gs.id, 2, 1 FROM generate_series(1, 10000  ) as gs(id);
SELECT gs.id, gs.id, 2, 2 FROM generate_series(1, 10000  ) as gs(id);
SELECT gs.id, gs.id, 2, 3 FROM generate_series(1, 10000  ) as gs(id);
SELECT gs.id, gs.id, 2, 4 FROM generate_series(1, 10000  ) as gs(id);
SELECT gs.id, gs.id, 2, 5 FROM generate_series(1, 10000  ) as gs(id);