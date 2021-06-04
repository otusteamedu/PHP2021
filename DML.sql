-- Залы
CREATE TABLE `halls` (
	`id` INT(3) NOT NULL AUTO_INCREMENT,
	`seats_count` INT(3) NOT NULL,
	`hall_name` VARCHAR(255),
	PRIMARY KEY (`id`)
);

-- Места
CREATE TABLE `places` (
	`id` INT(3) NOT NULL AUTO_INCREMENT,
	`place` INT(3) NOT NULL,
	`row` INT(3),
	`hull_id` INT(3),
	PRIMARY KEY (`id`)
);

-- Сеансы
CREATE TABLE `sessions` (
	`id` INT(3) NOT NULL AUTO_INCREMENT,
	`session_date` DATE,
	`place_id` INT(6),
	`sessiont_time` TIME,
	`price` INT(1),
	`film_id` INT(5),
	PRIMARY KEY (`id`)
);

-- Фильмв
CREATE TABLE `films` (
	`id` INT(3) NOT NULL AUTO_INCREMENT,
	`film_name` VARCHAR(254),
	`director` VARCHAR(256),
	`film_duration` TIME,
	`genre` VARCHAR(256),
	PRIMARY KEY (`id`)
);

-- Кассиры
CREATE TABLE `cashiers` (
	`id` INT(3) NOT NULL AUTO_INCREMENT,
	`fio` VARCHAR(256),
	PRIMARY KEY (`id`)
);

-- Билеты
CREATE TABLE `tickets` (
	`id` INT(3) NOT NULL AUTO_INCREMENT,
	`date_of_sale` DATE,
	`cashier_id` INT(3),
	`session_id` INT(5),
	`ticket_price` INT(4),
	PRIMARY KEY (`id`)
);

