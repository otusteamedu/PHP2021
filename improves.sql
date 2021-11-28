
--
-- Name: name; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX name ON public.films USING btree (name);


--
-- Name: name_len; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX name_len ON public.films USING btree (length((name)::text));


--
-- Name: price; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX price ON public.sessions USING btree (price);