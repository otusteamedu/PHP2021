<?php

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {

    $connectionString = "mysql:" .
        "dbname=" . $_ENV["MYSQL_DATABASE"]
        . ";host=" . $_ENV["MYSQL_HOST"]
        . ";port=" . $_ENV["MYSQL_PORT"];

    $dbh = new PDO(
        $connectionString,
        $_ENV["MYSQL_USERNAME"],
        $_ENV["MYSQL_PASSWORD"]
    );

    $testQuery = $dbh->query('SHOW TABLES')->fetchObject();
    echo "Mysql connection established!";

    $dbh = null;

} catch (PDOException $e) {
    echo "Mysql connection failed: " . $e->getMessage();
    die();
}
echo "<br />";
echo "Hello, Otus!!!";

phpinfo();