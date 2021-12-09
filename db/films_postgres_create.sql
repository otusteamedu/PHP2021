/*
*Скрипт создания табл.БД films
*
*/



CREATE TABLE "film" (
	"id_film" serial NOT NULL,
	"title_film" varchar(100) NOT NULL,
	"description" varchar(255) NOT NULL,
	CONSTRAINT "film_pk" PRIMARY KEY ("id_film")
);



CREATE TABLE "film_attr_value" (
	"id_value" serial NOT NULL,
	"attr_id" integer NOT NULL,
	"value_date" TIMESTAMP NOT NULL,
	"value_text" varchar(255) NOT NULL,
	"value_num" FLOAT NOT NULL,
	"value_bool" BOOLEAN NOT NULL,
	"film_id" integer NOT NULL,
	CONSTRAINT "film_attr_value_pk" PRIMARY KEY ("id_value")
);



CREATE TABLE "film_attr_type" (
	"id_type" serial NOT NULL,
	"title_type" varchar(50) NOT NULL,
	"description" varchar(255) NOT NULL,
	CONSTRAINT "film_attr_type_pk" PRIMARY KEY ("id_type")
);



CREATE TABLE "film_attr" (
	"id_attr" serial NOT NULL,
	"title_attr" varchar(100) NOT NULL,
	"type_id" integer NOT NULL,
	CONSTRAINT "film_attr_pk" PRIMARY KEY ("id_attr")
);




ALTER TABLE "film_attr_value" ADD CONSTRAINT "film_attr_value_fk0" FOREIGN KEY ("attr_id") REFERENCES "film_attr"("id_attr");
ALTER TABLE "film_attr_value" ADD CONSTRAINT "film_attr_value_fk1" FOREIGN KEY ("film_id") REFERENCES "film"("id_film");


ALTER TABLE "film_attr" ADD CONSTRAINT "film_attr_fk0" FOREIGN KEY ("type_id") REFERENCES "film_attr_type"("id_type");

ALTER TABLE "film_attr_value" ALTER COLUMN "value_date" DROP NOT NULL;
ALTER TABLE "film_attr_value" ALTER COLUMN "value_text" DROP NOT NULL;
ALTER TABLE "film_attr_value" ALTER COLUMN "value_num" DROP NOT NULL;
ALTER TABLE "film_attr_value" ALTER COLUMN "value_bool" DROP NOT NULL;


INSERT INTO "film"("id_film","title_film","description") VALUES (1,'1+1','Пострадав в результате несчастного случая, богатый аристократ Филипп ...');
INSERT INTO "film"("id_film","title_film","description") VALUES (2,'Матрица','Фильм изображает будущее, в котором реальность, существующая для...');
INSERT INTO "film"("id_film","title_film","description") VALUES (3,'Аватар','Бывший морпех Джейк Салли прикован к инвалидному креслу. Несмотря на ...');


INSERT INTO "film_attr_type"("id_type","title_type","description") VALUES (1,'Дата','');
INSERT INTO "film_attr_type"("id_type","title_type","description") VALUES (2,'Текст','');
INSERT INTO "film_attr_type"("id_type","title_type","description") VALUES (3,'Стоимость','');
INSERT INTO "film_attr_type"("id_type","title_type","description") VALUES (4,'Количество','');



INSERT INTO "film_attr"("id_attr","title_attr","type_id") VALUES (1,'Выход в прокат',1);
INSERT INTO "film_attr"("id_attr","title_attr","type_id") VALUES (2,'Информация к фильму',2);
INSERT INTO "film_attr"("id_attr","title_attr","type_id") VALUES (3,'Актер',2);
INSERT INTO "film_attr"("id_attr","title_attr","type_id") VALUES (4,'Сборы по фильму',3);

INSERT INTO "film_attr"("id_attr","title_attr","type_id") VALUES (5,'Обсуждение деталей',1);
INSERT INTO "film_attr"("id_attr","title_attr","type_id") VALUES (6,'Задача по согласованию',1);
INSERT INTO "film_attr"("id_attr","title_attr","type_id") VALUES (7,'Запуск рекламы',1);
INSERT INTO "film_attr"("id_attr","title_attr","type_id") VALUES (8,'Запуск фильма',1);
INSERT INTO "film_attr"("id_attr","title_attr","type_id") VALUES (9,'Выход из проката',1);

INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (1,1,'2010-10-04 10:00:00',NULL,NULL,NULL,1);
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (2,3,NULL,'Француа Клюзе',NULL,NULL,1);
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (3,4,NULL,NULL,1725813,NULL,1);

INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (4,1,'2012-05-07 10:00:00',NULL,NULL,NULL,3);
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (5,3,NULL,'Сэм Уортингтон',NULL,NULL,3);
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (6,4,NULL,NULL,119903638,NULL,3);
	
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (7,6,NOW(),NULL,NULL,NULL,1);
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (8,7,'2021-12-04 10:00:00',NULL,NULL,NULL,2);
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (9,8,'2021-12-12 10:00:00',NULL,NULL,NULL,3);
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (10,7,NOW(),NULL,NULL,NULL,3);
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (11,5,'2021-12-24 10:00:00',NULL,NULL,NULL,2);
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (12,5,'2021-12-26 10:00:00',NULL,NULL,NULL,2);
INSERT INTO "film_attr_value"("id_value","attr_id", "value_date", "value_text", "value_num", "value_bool", "film_id") 
	VALUES (13,9,'2021-12-27 10:00:00',NULL,NULL,NULL,1);
	


/*Запрос с case. */
SELECT "film"."title_film","film_attr_type"."title_type","film_attr"."title_attr", 
CASE 
WHEN "film_attr_value"."value_date" IS NOT NULL THEN "film_attr_value"."value_date"::text
WHEN "film_attr_value"."value_text" IS NOT NULL THEN "film_attr_value"."value_text"::text
WHEN "film_attr_value"."value_num" IS NOT NULL THEN "film_attr_value"."value_num"::text
WHEN "film_attr_value"."value_bool" IS NOT NULL THEN "film_attr_value"."value_bool"::text
ELSE NULL
END AS "value" FROM "film"
INNER JOIN "film_attr_value" ON	"film"."id_film" = "film_attr_value"."film_id"
INNER JOIN "film_attr" ON "film_attr_value"."attr_id" = "film_attr"."id_attr"
INNER JOIN "film_attr_type" ON  "film_attr"."type_id"= "film_attr_type"."id_type";


/*Запрос с задачами. */
SELECT "film"."title_film", 
	(SELECT string_agg("film_attr"."title_attr", ', ' ORDER BY "film_attr"."title_attr") FROM "film_attr_value"
	INNER JOIN "film_attr" ON "film_attr_value"."attr_id" = "film_attr"."id_attr"
	WHERE DATE("film_attr_value"."value_date") = CURRENT_DATE AND "film_attr_value"."film_id"="film"."id_film")
	AS "act_tasks",
	(SELECT string_agg("film_attr"."title_attr", ', ' ORDER BY "film_attr"."title_attr") FROM "film_attr_value"
	INNER JOIN "film_attr" ON "film_attr_value"."attr_id" = "film_attr"."id_attr"
	WHERE DATE("film_attr_value"."value_date") > (CURRENT_DATE + INTERVAL '20 days') AND "film_attr_value"."film_id"="film"."id_film")
	AS "after20day_tasks"
FROM "film"
INNER JOIN "film_attr_value" ON	"film"."id_film" = "film_attr_value"."film_id"
INNER JOIN "film_attr" ON "film_attr_value"."attr_id" = "film_attr"."id_attr"
INNER JOIN "film_attr_type" ON  "film_attr"."type_id"= "film_attr_type"."id_type"
GROUP BY "film"."id_film"
ORDER BY "film"."title_film" ASC;