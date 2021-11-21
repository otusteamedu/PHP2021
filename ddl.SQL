/*
Created: 20.11.2021
Modified: 21.11.2021
Model: MySQL 8.0
Database: MySQL 8.0
*/

-- Create tables section -------------------------------------------------

-- Table ticket

CREATE TABLE `ticket`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `number` Int NOT NULL,
  `price` Decimal(18,2) NOT NULL,
  `discount` Decimal(18,2) NOT NULL DEFAULT 0,
  `created_at` Datetime NOT NULL,
  `updated_at` Datetime,
  `session_id` Int NOT NULL,
  `seat_id` Int NOT NULL,
  `order_id` Int NOT NULL,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `ix_relationship_ticket_by_session` ON `ticket` (`session_id`)
;

CREATE INDEX `ix_relationship_ticket_by_seat` ON `ticket` (`seat_id`)
;

CREATE INDEX `ix_relationship_ticket_by_order` ON `ticket` (`order_id`)
;

-- Table hall

CREATE TABLE `hall`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Varchar(200) NOT NULL,
  `count` Smallint NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table client

CREATE TABLE `client`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `first_name` Varchar(200) NOT NULL,
  `last_name` Varchar(200) NOT NULL,
  `second_name` Varchar(200),
  PRIMARY KEY (`id`)
)
;

-- Table movie

CREATE TABLE `movie`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table session

CREATE TABLE `session`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `price` Decimal(18,2) NOT NULL,
  `time_start` Datetime NOT NULL,
  `time_end` Datetime NOT NULL,
  `movie_id` Int NOT NULL,
  `hall_id` Int NOT NULL,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `ix_relationship_session_by_movie` ON `session` (`movie_id`)
;

CREATE INDEX `ix_relationship_session_by_hall` ON `session` (`hall_id`)
;

-- Table order

CREATE TABLE `order`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `created_at` Datetime NOT NULL,
  `updated_at` Datetime,
  `is_paid` Bool NOT NULL DEFAULT false,
  `paid_at` Datetime,
  `is_canceled` Bool NOT NULL DEFAULT false,
  `canceled_at` Datetime,
  `client_id` Int NOT NULL,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `ix_relationship_order_by_client` ON `order` (`client_id`)
;

-- Table basket

CREATE TABLE `basket`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `created_at` Datetime NOT NULL,
  `updated_at` Datetime,
  `price` Decimal(18,2) NOT NULL,
  `discount` Float,
  `order_id` Int,
  `client_id` Int NOT NULL,
  `ticket_id` Int NOT NULL,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `ix_relationship_basket_by_order` ON `basket` (`order_id`)
;

CREATE INDEX `ix_relationship_basket_by_client` ON `basket` (`client_id`)
;

CREATE INDEX `ix_relationship_basket_by_ticket` ON `basket` (`ticket_id`)
;

-- Table seat

CREATE TABLE `seat`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `row` Smallint NOT NULL,
  `number` Smallint NOT NULL,
  `hall_id` Int NOT NULL,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `ix_relationship_seat_by_hall` ON `seat` (`hall_id`)
;

-- Create foreign keys (relationships) section -------------------------------------------------

ALTER TABLE `session` ADD CONSTRAINT `relationship_session_by_movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `session` ADD CONSTRAINT `relationship_session_by_ball` FOREIGN KEY (`hall_id`) REFERENCES `hall` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `ticket` ADD CONSTRAINT `relationship_ticket_by_session` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `basket` ADD CONSTRAINT `relationship_basket_by_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `basket` ADD CONSTRAINT `relationship_basket_by_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `basket` ADD CONSTRAINT `relationship_basket_by_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `seat` ADD CONSTRAINT `relationship_seat_by_hall` FOREIGN KEY (`hall_id`) REFERENCES `hall` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `ticket` ADD CONSTRAINT `relationship_ticket_by_seat` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `order` ADD CONSTRAINT `relationship_order_by_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `ticket` ADD CONSTRAINT `relationship_ticket_by_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

