CREATE TABLE IF NOT EXISTS `orders` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `summ` decimal(10, 2) NULL DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;