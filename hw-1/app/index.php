<?php
error_reporting(E_ERROR | E_PARSE); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Hello World!</h1>
        <?php
        $m = new Memcached();
        $m->addServer('snikonov-memcached',11211);
        $statuses = $m->getStats();
        if ($statuses['snikonov-memcached:11211']['uptime'] < 1):
            echo '<p>Memcached BREAK</p>';
        else:
            echo '<p>Memcached WORK</p>';
        endif;

        try {
            $redis = new Redis();
            if ($redis->connect('redis', 6379)):
                echo '<p>Redis WORK</p>';
            endif;
        } catch (Exception $e) {
            echo '<p>Redis BREAK</p>';
        }

        $host = 'db';
        $database = 'otus';
        $user = 'otus';
        $password = 'password';
        $conn = mysqli_connect($host, $user, $password, $database);
        if (!$conn):
            echo '<p>MySQL BREAK</p>';
        else:
            echo '<p>MySQL WORK</p>';
            mysqli_close($conn);
        endif;

        phpinfo(); ?>
    </body>
</html>
