CREATE TABLE IF NOT EXISTS `bookings` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`seat_id` int unsigned NOT NULL,
`session_id` bigint unsigned NOT NULL,
`user_id` bigint unsigned DEFAULT NULL,
`group_price_id` int unsigned DEFAULT NULL,
`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`deleted_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `seat_id_session_id` (`seat_id`,`session_id`),
KEY `bookings_group_price_id_foreign` (`group_price_id`),
KEY `bookings_session_id_foreign` (`session_id`),
KEY `bookings_user_id_foreign` (`user_id`),
CONSTRAINT `bookings_group_price_id_foreign` FOREIGN KEY (`group_price_id`) REFERENCES `group_prices` (`id`),
CONSTRAINT `bookings_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`),
CONSTRAINT `bookings_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `group_prices` (
`id` int unsigned NOT NULL AUTO_INCREMENT,
`base_price` double(10,2) unsigned NOT NULL,
`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`deleted_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `halls` (
`id` int unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(255) DEFAULT NULL,
`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`deleted_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `movies` (
`id` int unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`available_from` timestamp NULL DEFAULT NULL,
`available_to` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `seats` (
`id` int unsigned NOT NULL AUTO_INCREMENT,
`number` int unsigned NOT NULL,
`hall_id` int unsigned NOT NULL,
`group_price_id` int unsigned NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `number_hall_id` (`number`,`hall_id`),
KEY `seats_group_price_id_foreign` (`group_price_id`),
KEY `seats_hall_id_foreign` (`hall_id`),
CONSTRAINT `seats_group_price_id_foreign` FOREIGN KEY (`group_price_id`) REFERENCES `group_prices` (`id`),
CONSTRAINT `seats_hall_id_foreign` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `sessions` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`hall_id` int unsigned NOT NULL,
`movie_id` int unsigned NOT NULL,
`coefficient` tinyint unsigned DEFAULT NULL,
`start_at` timestamp NOT NULL,
`end_at` timestamp NOT NULL,
PRIMARY KEY (`id`),
KEY `sessions_hall_id_foreign` (`hall_id`),
KEY `sessions_movie_id_foreign` (`movie_id`),
CONSTRAINT `sessions_hall_id_foreign` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`),
CONSTRAINT `sessions_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `users` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
`deleted_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
