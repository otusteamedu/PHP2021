# PHP2021

https://otus.ru/lessons/razrabotchik-php/?utm_source=github&utm_medium=free&utm_campaign=otus

Инструкцию по запуску

Ссылка на файл для swagger:

http://queue.local/swagger/swagger.yaml

Создание таблиц:

CREATE TABLE public.products (
	id serial4 NOT NULL,
	"name" varchar NULL,
	price numeric NULL,
	category varchar NULL,
	created date NULL DEFAULT CURRENT_TIMESTAMP,
	modified date NULL,
	CONSTRAINT products_pkey PRIMARY KEY (id)
);

CREATE TABLE public.queue (
	id serial4 NOT NULL,
	status varchar NULL,
	created date NULL DEFAULT CURRENT_TIMESTAMP,
	modified date NULL,
	CONSTRAINT queue_pkey PRIMARY KEY (id)
);

Для обработки очереди открыть в консоле App.php