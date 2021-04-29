<?php
echo "Hello, Otus!</br>";
try {
    $conn = new mysqli('localhost', 'homestead', 'secret');
    $db_list = mysqli_query($conn, "SHOW DATABASES");
    echo "Databases available: ";
    while($row = mysqli_fetch_assoc($db_list)) {
        echo $row["Database"] . " ";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
phpinfo();