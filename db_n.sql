
-- -----------------------------------------------------
-- Schema cinema
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cinema` DEFAULT CHARACTER SET utf8 ;
USE `cinema` ;

-- -----------------------------------------------------
-- Table `cinema`.`hall`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`hall` (
  `id_hall` INT NOT NULL AUTO_INCREMENT,
  `title_hall` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `num_rows` INT(2) NULL DEFAULT NULL,
  `num_seats` INT(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_hall`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`film`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`film` (
  `id_film` INT NOT NULL AUTO_INCREMENT,
  `title_film` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `date_start` DATETIME NULL DEFAULT NULL,
  `date_end` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id_film`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`session`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`session` (
  `id_session` INT NOT NULL AUTO_INCREMENT,
  `hall_id` INT NOT NULL,
  `time` DATETIME NULL DEFAULT NULL,
  `film_id` INT NOT NULL,
  PRIMARY KEY (`id_session`),
  FOREIGN KEY (`film_id`)
	  REFERENCES `cinema`.`film` (`id_film`)
	  ON DELETE CASCADE
	  ON UPDATE NO ACTION,
  FOREIGN KEY (`hall_id`)
    REFERENCES `cinema`.`hall` (`id_hall`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`sector`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`sector` (
  `id_sector` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_sector`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`seat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`seat` (
  `id_seat` INT NOT NULL AUTO_INCREMENT,
  `hall_id` INT NOT NULL,
  `num_row` INT(2) NULL DEFAULT NULL,
  `num_seat` INT(2) NULL DEFAULT NULL,
  `sector_id` INT NOT NULL,
  PRIMARY KEY (`id_seat`),
  FOREIGN KEY (`sector_id`)
    REFERENCES `cinema`.`sector` (`id_sector`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (`hall_id`)
    REFERENCES `cinema`.`hall` (`id_hall`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cinema`.`bonus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`bonus` (
  `id_bonus` INT NOT NULL AUTO_INCREMENT,
  `title_bonus` VARCHAR(45) NULL,
  `size_discont` FLOAT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_bonus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`ticket` (
  `id_ticket` INT NOT NULL AUTO_INCREMENT,
  `date_creation` DATETIME NULL DEFAULT NULL,
  `session_id` INT NOT NULL,
  `seat_id` INT NOT NULL,
  `stat_paidfor` TINYINT(1) NOT NULL DEFAULT 0,
  `stat_booking` TINYINT(1) NOT NULL DEFAULT 0,
  `stat_refusal` TINYINT(1) NOT NULL DEFAULT 0,
  `bonus_id` INT NULL DEFAULT NULL,
  `price_fact` DECIMAL(8,2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_ticket`),
  FOREIGN KEY (`seat_id`)
    REFERENCES `cinema`.`seat` (`id_seat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (`session_id`)
    REFERENCES `cinema`.`session` (`id_session`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (`bonus_id`)
    REFERENCES `cinema`.`bonus` (`id_bonus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cinema`.`price`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`price` (
  `session_id` INT NOT NULL,
  `date` DATETIME NULL DEFAULT NULL,
  `sector_id` INT NOT NULL,
  `price` DECIMAL(8,2) NULL DEFAULT NULL,
  PRIMARY KEY (`session_id`, `sector_id`),
  FOREIGN KEY (`sector_id`)
    REFERENCES `cinema`.`sector` (`id_sector`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  FOREIGN KEY (`session_id`)
    REFERENCES `cinema`.`session` (`id_session`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`position`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`position` (
  `id_position` INT NOT NULL AUTO_INCREMENT,
  `title_positioncol` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_position`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`employee` (
  `id_employee` INT NOT NULL AUTO_INCREMENT,
  `fio` VARCHAR(100) NULL DEFAULT NULL,
  `position_id` INT NOT NULL,
  PRIMARY KEY (`id_employee`),
  FOREIGN KEY (`position_id`)
    REFERENCES `cinema`.`position` (`id_position`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`order` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `order` VARCHAR(45) NULL DEFAULT NULL,
  `employee_id` INT NOT NULL,
  `date_order` DATETIME NULL DEFAULT NULL,
  `ticket_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`employee_id`)
    REFERENCES `cinema`.`employee` (`id_employee`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (`ticket_id`)
    REFERENCES `cinema`.`ticket` (`id_ticket`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

