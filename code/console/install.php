<?php

use Orders\Data\Storage\StorageAdapter;

require_once(__DIR__ . "/../bootstrap/app.php");

$storageAdapter = new StorageAdapter();
$storageAdapter->createQuery('
    CREATE TABLE `orders` (
      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      `summ` decimal(10, 2) NULL DEFAULT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
');
