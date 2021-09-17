-- get_rand_hall
DELIMITER //
DROP FUNCTION IF EXISTS get_rand_hall;//
DELIMITER ;

DELIMITER //
CREATE FUNCTION get_rand_hall()
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE tmp_id INT;

    SELECT `id` INTO tmp_id FROM `halls` ORDER BY RAND() LIMIT 1;

    RETURN tmp_id;
END//
DELIMITER ;

-- get_rand_movie
DELIMITER //
DROP FUNCTION IF EXISTS get_rand_movie;//
DELIMITER ;

DELIMITER //
CREATE FUNCTION get_rand_movie()
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE tmp_id INT;

    SELECT `id` INTO tmp_id FROM `movies` ORDER BY RAND() LIMIT 1;

    RETURN tmp_id;
END//
DELIMITER ;


-- get_rand_price_range
DELIMITER //
DROP FUNCTION IF EXISTS get_rand_price_range;//
DELIMITER ;

DELIMITER //
CREATE FUNCTION get_rand_price_range()
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE tmp_id INT;

    SELECT `id` INTO tmp_id FROM `price_ranges` ORDER BY RAND() LIMIT 1;

    RETURN tmp_id;
END//
DELIMITER ;

-- get_rand_screening
DELIMITER //
DROP FUNCTION IF EXISTS get_rand_screening;//
DELIMITER ;

DELIMITER //
CREATE FUNCTION get_rand_screening()
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE tmp_id INT;

    SELECT `id` INTO tmp_id FROM `screenings` ORDER BY RAND() LIMIT 1;

    RETURN tmp_id;
END//
DELIMITER ;

-- get_seat_for_screening
DELIMITER //
DROP FUNCTION IF EXISTS get_seat_for_screening;//
DELIMITER ;

DELIMITER //
CREATE FUNCTION get_seat_for_screening( screening INT )
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE tmp_id INT;

    SELECT `seats`.`id` INTO tmp_id
    FROM `screenings`
    INNER JOIN `halls` ON  `halls`.`id` = `screenings`.`hall`
    INNER JOIN `seats` ON  `seats`.`hall` = `halls`.`id`
    WHERE
        `screenings`.`id` = screening
    ORDER BY RAND()
    LIMIT 1;

    RETURN tmp_id;
END//
DELIMITER ;



-- insert_screenings
DELIMITER //
DROP PROCEDURE IF EXISTS insert_screenings;//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE insert_screenings( num_records INT )
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE ts_start datetime DEFAULT '2000-01-01 00:10:00';

    WHILE i <= num_records DO
        INSERT INTO `screenings` (`id`, `hall`, `movie`, `price_range`, `ts_start`)
        VALUES (
            NULL,
            get_rand_hall(),
            get_rand_movie(),
            get_rand_price_range(),
            ts_start
        );

        SET i = i + 1;
        SET ts_start = ADDDATE(ts_start, INTERVAL 137 MINUTE );
    END WHILE;
END//
DELIMITER ;

CALL insert_screenings(100);


-- insert_orders
DELIMITER //
DROP PROCEDURE IF EXISTS insert_orders;//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE insert_orders( num_records INT )
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE screening, seat INT;

    WHILE i <= num_records DO
        SET screening = get_rand_screening();
        SET seat = get_seat_for_screening(screening);

        INSERT INTO `orders` (`id`, `screening`, `seat`)
        VALUES (NULL, screening, seat);

        SET i = i + 1;
    END WHILE;
END//
DELIMITER ;

CALL insert_orders(10000);


