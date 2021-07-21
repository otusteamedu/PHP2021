<?php
    $connectionString = 'mysql:dbname=homestead;host=127.0.0.1;port=3306';
    $dbh = new PDO(
        $connectionString,
        "homestead",
        "secret",
        [
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
        ]
    );
    $testQuery = $dbh->query('SHOW TABLES');
    print_r($testQuery);
    $dbh = null;
