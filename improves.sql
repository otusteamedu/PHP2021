CREATE INDEX name ON public.films USING btree (name);
--
-- CREATE INDEX cheap_price ON public.sessions USING btree (price)
-- WHERE price < 300;
--
-- CREATE INDEX name_len ON public.films USING btree (length(name)) INCLUDE (name);
--
-- CREATE INDEX film_id ON public.sessions USING btree (film_id);
-- CREATE INDEX id ON public.films USING btree (id);

CREATE INDEX seat_hall_zone_id ON public.seats USING btree (hall_zone_id);
