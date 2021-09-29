INSERT INTO public.types_attributes ("type") VALUES
	 ('int'),
	 ('boolean'),
	 ('float'),
	 ('date'),
	 ('text');
	
INSERT INTO public."attributes" (id_types_attributes,"name") values
	 (3,'Оскар'),
	 (3,'Золотой глобус'),
	 (3,'Ника'),
	 (1,'Отзыв'),
	 (5,'Мировая премьера'),
	 (5,'Премьера в россии'),
	 (5,'Начало рекламы'),
	 (4,'Рейтинг'),
	 (1,'Режиссер');
	
INSERT INTO public.movies (name) VALUES
	 ('Фильм 1'),
	 ('Фильм 2');

INSERT INTO public.values (id_movie,id_attribute,value_text,value_int,value_boolean,value_float,value_date) VALUES
	 (2,2,NULL,NULL,true,NULL,NULL),
	 (2,3,NULL,NULL,false,NULL,NULL),
	 (2,4,'Положительный отзыв',NULL,NULL,NULL,NULL),
	 (2,5,NULL,NULL,NULL,NULL,'2021-09-29'),
	 (2,6,NULL,NULL,NULL,NULL,'2021-10-29'),
	 (2,7,NULL,NULL,NULL,NULL,'2021-10-19'),
	 (2,8,'Режиссер',NULL,NULL,NULL,NULL),
	 (2,9,NULL,NULL,NULL,9.7,NULL);