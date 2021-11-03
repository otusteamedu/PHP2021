CREATE TABLE IF NOT EXISTS `movies` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `movie_attributes` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
`movie_attribute_type_id` bigint unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `FK_movie_attributes_movie_attribute_type` (`movie_attribute_type_id`),
CONSTRAINT `FK_movie_attributes_movie_attribute_type` FOREIGN KEY (`movie_attribute_type_id`) REFERENCES `movie_attribute_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `movie_attribute_type` (
`id` bigint unsigned NOT NULL DEFAULT '0',
`name` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `movie_attribute_values` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`movie_id` bigint unsigned NOT NULL,
`movie_attribute_id` bigint unsigned NOT NULL,
`val_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
`val_date` timestamp NULL DEFAULT NULL,
`val_int` int DEFAULT NULL,
`val_bool` tinyint(1) DEFAULT NULL,
`val_real` decimal(20,6) DEFAULT NULL,
`val_movie_award_id` int unsigned DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `FK_movie_attribute_values_movies` (`movie_id`),
KEY `FK_movie_attribute_values_movie_attributes` (`movie_attribute_id`),
KEY `FK_movie_attribute_values_movie_awards` (`val_movie_award_id`),
CONSTRAINT `FK_movie_attribute_values_movie_attributes` FOREIGN KEY (`movie_attribute_id`) REFERENCES `movie_attributes` (`id`),
CONSTRAINT `FK_movie_attribute_values_movie_awards` FOREIGN KEY (`val_movie_award_id`) REFERENCES `movie_awards` (`id`),
CONSTRAINT `FK_movie_attribute_values_movies` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `movie_awards` (
`id` int unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
