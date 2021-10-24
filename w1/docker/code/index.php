<?php
    echo "Hello, Otus!  <br>";

    $redis = new Redis();
    $redis->connect('redis', 6379);
    echo "Redis connected <br>";

    $memcached = new Memcached();
    $memcached->addServer("memcached", 11211);
    echo "Memcached connected <br>";

    $servername = "db";
    $database = "whdb";
    $username = "user";
    $password = "secret";

    $conn = mysqli_connect($servername, $username, $password, $database, 3306);

    if (mysqli_connect_errno($conn)) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    echo "MySQL connected";

