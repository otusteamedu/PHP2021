CREATE TABLE `movies` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(50) DEFAULT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Фильмы';

CREATE TABLE `movies_attribute_types` (
  `name` varchar(20) NOT NULL COMMENT 'ID',
  `title` varchar(50) DEFAULT NULL COMMENT 'Название',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Фильмы: типы аттрибутов';

CREATE TABLE `movies_attributes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(20) DEFAULT NULL COMMENT 'Тип',
  `title` varchar(50) DEFAULT NULL COMMENT 'Название',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  CONSTRAINT `movies_attributes_type` FOREIGN KEY (`type`) REFERENCES `movies_attribute_types` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Фильмы: аттрибуты';

CREATE TABLE `movies_attribute_values` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `movie` int(11) UNSIGNED NOT NULL COMMENT 'Фильм',
  `attribute` int(11) UNSIGNED NOT NULL COMMENT 'Аттрибут',
  `value_boolean` enum('0','1') DEFAULT NULL COMMENT 'Значение: boolean',
  `value_integer` int(11) SIGNED DEFAULT NULL COMMENT 'Значение: integer',
  `value_float` decimal(10,2) SIGNED DEFAULT NULL COMMENT 'Значение: float',
  `value_string` varchar(255) DEFAULT NULL COMMENT 'Значение: string',
  `value_date` date DEFAULT NULL COMMENT 'Значение: date',
  `value_text` text DEFAULT NULL COMMENT 'Значение: text',
  PRIMARY KEY (`id`),
  KEY `attribute` (`attribute`),
  KEY `movie` (`movie`),
  CONSTRAINT `movies_attributes_attribute` FOREIGN KEY (`attribute`) REFERENCES `movies_attributes` (`id`),
  CONSTRAINT `movies_attributes_movie` FOREIGN KEY (`movie`) REFERENCES `movies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Фильмы: значения аттрибутов';

