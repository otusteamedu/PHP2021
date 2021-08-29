CREATE TABLE `halls` (
  `id` tinyint(1) UNSIGNED NOT NULL COMMENT 'ID',
  `title` varchar(50) DEFAULT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Залы';

CREATE TABLE `movies` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `title` varchar(50) DEFAULT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Фильмы';

CREATE TABLE `price_ranges` (
  `id` tinyint(1) UNSIGNED NOT NULL COMMENT 'ID',
  `title` varchar(50) DEFAULT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Диапазоны цен';

CREATE TABLE `price_types` (
  `id` tinyint(1) UNSIGNED NOT NULL COMMENT 'ID',
  `title` varchar(255) DEFAULT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Типы цен';

CREATE TABLE `price_types_price_ranges` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `type` tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Тип цены',
  `range` tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Диапазон цены',
  `value` int(11) UNSIGNED NOT NULL COMMENT 'Цена в рублях',
  PRIMARY KEY (`id`),
  KEY `range` (`range`),
  KEY `type` (`type`),
  CONSTRAINT `price_types_price_ranges_type` FOREIGN KEY (`type`) REFERENCES `price_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `price_types_price_ranges_range` FOREIGN KEY (`range`) REFERENCES `price_ranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Типы мест, диапазоны цен';

CREATE TABLE `seats` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `hall` tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Зал',
  `type` tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Тип цены',
  `row` tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Ряд',
  `number` tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Место',
  PRIMARY KEY (`id`),
  KEY `hall` (`hall`),
  KEY `type` (`type`),
  CONSTRAINT `seats_hall` FOREIGN KEY (`hall`) REFERENCES `halls` (`id`),
  CONSTRAINT `seats_type` FOREIGN KEY (`type`) REFERENCES `price_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Места';

CREATE TABLE `screenings` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `hall` tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Зал',
  `movie` int(11) UNSIGNED DEFAULT NULL COMMENT 'Фильм',
  `price_range` tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Диапазон цен',
  `ts_start` datetime DEFAULT NULL COMMENT 'Время начала показа',
  PRIMARY KEY (`id`),
  KEY `hall` (`hall`),
  KEY `movie` (`movie`),
  KEY `price_range` (`price_range`),
  CONSTRAINT `screenings_halls` FOREIGN KEY (`hall`) REFERENCES `halls` (`id`),
  CONSTRAINT `screenings_movie` FOREIGN KEY (`movie`) REFERENCES `movies` (`id`),
  CONSTRAINT `screenings_price_range` FOREIGN KEY (`price_range`) REFERENCES `price_ranges` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Показы';

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `screening` int(11) UNSIGNED NOT NULL COMMENT 'Показ',
  `seat` int(11) UNSIGNED NOT NULL COMMENT 'Место',
  PRIMARY KEY (`id`),
  KEY `screening` (`screening`),
  KEY `seat` (`seat`),
  CONSTRAINT `orders_screening` FOREIGN KEY (`screening`) REFERENCES `screenings` (`id`),
  CONSTRAINT `orders_seat` FOREIGN KEY (`seat`) REFERENCES `seats` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Заказы';
