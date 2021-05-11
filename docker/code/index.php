<?php
header( 'Content-Type: text/html; charset=utf-8' );
?>

    <ul>
        <li>
            <a href="./test_mysql.php">MySQL test</a>
        </li>
        <li>
            <a href="./test_redis.php">Redis test</a>
        </li>
        <li>
            <a href="./test_memcached.php">Memcached test</a>
        </li>
    </ul>

<?php
phpinfo();