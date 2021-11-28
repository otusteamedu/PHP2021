CREATE INDEX cheap_price ON public.sessions USING btree (price)
WHERE price > 300;