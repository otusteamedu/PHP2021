CREATE TABLE `halls` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
    `hall_name` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`count_seats` INT(10) NOT NULL,
	PRIMARY KEY (`id`)
);

INSERT INTO `halls` (`id`,`hall_name`, `count_seats`) VALUES 
('1','Зал А', '12'),
('2','Зал Б', '12');

CREATE TABLE `sessions` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`date_session` DATE,
	`time_session` TIME,
	PRIMARY KEY (`id`)
);

INSERT INTO `sessions` (`id`, `date_session`, `time_session`) VALUES 
    ('1', '2021-05-29', '14:30:00'), 
    ('2', '2021-05-30', '16:30:00');


CREATE TABLE `tickets` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`price` INT(10),
	`date_sale` DATE,
	PRIMARY KEY (`id`)
);


INSERT INTO `tickets` (`id`, `price`, `date_sale`) VALUES 
    ('1', '250', '2021-05-22'), 
    ('2', '330', '2021-05-30');


CREATE TABLE `places` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`row` INT(10),
	`place` INT(10),
	PRIMARY KEY (`id`)
);



INSERT INTO `places` (`id`, `row`, `place`) VALUES 
('1', '1', '1'), 
('3', '1', '2'),
('4', '1', '3'), 
('5', '1', '4'),

('6', '2', '1'), 
('7', '2', '2'),
('8', '2', '3'), 
('9', '2', '4'),

('10', '3', '1'), 
('11', '3', '2'),
('12', '3', '3'), 
('13', '3', '4'),

('14', '4', '1'), 
('15', '4', '2'),
('16', '4', '3'), 
('17', '4', '4');




CREATE TABLE `films` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`film_name` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`drector` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`duration` TIME,
	`genre` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY (`id`)
);


INSERT INTO `films` (`id`, `film_name`, `drector`, `duration`, `genre`) VALUES 
('1', 'Форсаж 9', 'Джастин Лин', '13:30:08', 'боевик'), 
('2', 'Кролик Питер 2', 'Уилл Глак', '25:30:08', 'мультфильм');


CREATE TABLE `cashiers` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`fio` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY (`id`)
);


INSERT INTO `cashiers` (`id`, `fio`) VALUES 
('1', 'Иванова Василиса Петровна'), 
('2', 'Безстрашный Сергей Петрович');




CREATE TABLE `hall_place` (
	`hall` INT(10) NOT NULL,
	`place` INT NOT NULL
);



INSERT INTO `hall_place` (`hall`, `place`) VALUES 
    ('1', '9'), 
    ('2', '8');



CREATE TABLE `hall_session` (
	`hall` INT(10) NOT NULL,
	`session` INT NOT NULL
);

INSERT INTO `hall_session` (`hall`, `session`) VALUES 
    ('1', '1'), 
    ('2', '2');

CREATE TABLE `session_ticket` (
	`session` INT(10) NOT NULL,
	`ticket` INT NOT NULL
);

INSERT INTO `session_ticket` (`session`, `ticket`) VALUES 
    ('1', '1'), 
    ('2', '2');


CREATE TABLE `ticket_place` (
	`ticket` INT(10) NOT NULL,
	`place` INT NOT NULL
);

INSERT INTO `ticket_place` (`ticket`, `place`) VALUES 
    ('1', '1'), 
    ('2', '10');


CREATE TABLE `ticket_cashier` (
	`ticket` INT(10) NOT NULL,
	`cashier` INT NOT NULL
);

INSERT INTO `ticket_cashier` (`ticket`, `cashier`) VALUES 
    ('1', '1'), 
    ('2', '2');

CREATE TABLE `session_film` (
	`session` INT(10) NOT NULL,
	`film` INT NOT NULL
);

INSERT INTO `session_film` (`session`, `film`) VALUES 
    ('1', '1'), 
    ('2', '2');