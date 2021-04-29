<?php
echo "Hello, Otus!";

// test memcached
echo "</br>Memcached test:</br>";

$memcached = new Memcached();
$memcached->addServer('otus_1_memcached', 11211);
print_r($memcached->getServerList());
//set data
$result = $memcached->get("cachekey");
if ($result) {
    echo $result;
} else {
    echo "No matching key found yet.";
    $memcached->set("cachekey", "cached data is available");
}

// test database connection
echo "</br>Database test:</br>";

try {
    $conn = new mysqli('otus_1_db', 'otus_1', 'root');
    $db_list = mysqli_query($conn, "SHOW DATABASES");
    echo "Databases available: ";
    while($row = mysqli_fetch_assoc($db_list)) {
        echo $row["Database"] . " ";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
mysqli_close($conn);

// test redis
echo "</br>Redis test:</br>";

$redis = new Redis();
if ($redis->connect('otus_1_redis', 6379)) {
    echo "Redis server is running: " . $redis->ping();
} else {
    echo "Redis doesnt work";
}