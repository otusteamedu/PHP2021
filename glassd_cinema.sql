-- --------------------------------------------------------
-- Хост:                         18.185.215.185
-- Версия сервера:               PostgreSQL 14.1 (Debian 14.1-1.pgdg110+1) on x86_64-pc-linux-gnu, compiled by gcc (Debian 10.2.1-6) 10.2.1 20210110, 64-bit
-- Операционная система:         
-- HeidiSQL Версия:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES  */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

CREATE TABLE "films" (
	"id" INTEGER NOT NULL DEFAULT 'nextval(''test_id_seq''::regclass)',
	"film_name" TEXT NOT NULL,
	"director" TEXT NULL DEFAULT NULL,
	"actors" TEXT NULL DEFAULT NULL,
	PRIMARY KEY ("id")
)
;
COMMENT ON COLUMN "films"."id" IS '';
COMMENT ON COLUMN "films"."film_name" IS '';
COMMENT ON COLUMN "films"."director" IS '';
COMMENT ON COLUMN "films"."actors" IS '';

CREATE TABLE "film_time" (
	"id" INTEGER NOT NULL DEFAULT 'nextval(''film_time_id_seq''::regclass)',
	"date_time" TIMESTAMP NULL DEFAULT 'CURRENT_TIMESTAMP',
	"film_id" INTEGER NOT NULL,
	"hall_id" INTEGER NOT NULL,
	"base_price" DOUBLE PRECISION NOT NULL,
	PRIMARY KEY ("id"),
	CONSTRAINT "FK_film_time_films" FOREIGN KEY ("film_id") REFERENCES "public"."films" ("id") ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT "FK_film_time_hall_info" FOREIGN KEY ("hall_id") REFERENCES "public"."hall_info" ("id") ON UPDATE CASCADE ON DELETE CASCADE
)
;
COMMENT ON COLUMN "film_time"."id" IS '';
COMMENT ON COLUMN "film_time"."date_time" IS '';
COMMENT ON COLUMN "film_time"."film_id" IS '';
COMMENT ON COLUMN "film_time"."hall_id" IS '';
COMMENT ON COLUMN "film_time"."base_price" IS '';

CREATE TABLE "hall_info" (
	"id" INTEGER NOT NULL DEFAULT 'nextval(''hall_info_id_seq''::regclass)',
	"hall_name" TEXT NOT NULL,
	"description" TEXT NULL DEFAULT NULL,
	PRIMARY KEY ("id")
)
;
COMMENT ON COLUMN "hall_info"."id" IS '';
COMMENT ON COLUMN "hall_info"."hall_name" IS '';
COMMENT ON COLUMN "hall_info"."description" IS '';

CREATE TABLE "places" (
	"id" INTEGER NOT NULL DEFAULT 'nextval(''places_id_seq''::regclass)',
	"hall_id" INTEGER NOT NULL,
	"row" INTEGER NOT NULL,
	"place" INTEGER NOT NULL,
	"type" VARCHAR(20) NULL DEFAULT 'NULL::character varying',
	PRIMARY KEY ("id"),
	UNIQUE INDEX "places_hall_id_row_place_key" ("hall_id", "row", "place"),
	CONSTRAINT "FK_places_hall_info" FOREIGN KEY ("hall_id") REFERENCES "public"."hall_info" ("id") ON UPDATE CASCADE ON DELETE CASCADE
)
;
COMMENT ON COLUMN "places"."id" IS '';
COMMENT ON COLUMN "places"."hall_id" IS '';
COMMENT ON COLUMN "places"."row" IS '';
COMMENT ON COLUMN "places"."place" IS '';
COMMENT ON COLUMN "places"."type" IS 'Тип места для генерации автоцены';

CREATE TABLE "tickets" (
	"id" INTEGER NOT NULL DEFAULT 'nextval(''tickets_id_seq''::regclass)',
	"film_time_id" INTEGER NOT NULL,
	"place_id" INTEGER NOT NULL,
	"user_info" TEXT NULL DEFAULT NULL,
	"price" DOUBLE PRECISION NOT NULL,
	PRIMARY KEY ("id"),
	CONSTRAINT "FK_tickets_film_time" FOREIGN KEY ("film_time_id") REFERENCES "public"."film_time" ("id") ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT "FK_tickets_places" FOREIGN KEY ("place_id") REFERENCES "public"."places" ("id") ON UPDATE CASCADE ON DELETE CASCADE
)
;
COMMENT ON COLUMN "tickets"."id" IS '';
COMMENT ON COLUMN "tickets"."film_time_id" IS '';
COMMENT ON COLUMN "tickets"."place_id" IS '';
COMMENT ON COLUMN "tickets"."user_info" IS '';
COMMENT ON COLUMN "tickets"."price" IS '';

