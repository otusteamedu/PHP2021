<?php
header( 'Content-Type: text/html; charset=utf-8' );

$db_host = getenv('MYSQL_HOST', true) ?: getenv('MYSQL_HOST');
$db_port = getenv('MYSQL_PORT', true) ?: getenv('MYSQL_PORT');
$db_name = getenv('MYSQL_DATABASE', true) ?: getenv('MYSQL_DATABASE');
$db_password  = getenv('MYSQL_ROOT_PASSWORD', true) ?: getenv('MYSQL_PASSWORD');

$pdo = new PDO(
    'mysql:host=' . $db_host
    . ';port=' . $db_port
    . ';dbname=' . $db_name
    . ';charset=utf8',
    'root',
    $db_password,
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    )
);
$pdo->exec( 'SET NAMES utf8' );

$s = $pdo->prepare( '
    CREATE TABLE IF NOT EXISTS `test_otus` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT "ID",
      `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "Timestamp"
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT="Test";
' );
$s->execute();

$s = $pdo->prepare( '
    INSERT INTO `test_otus` (`ts`) VALUES ( NOW() )
' );
$s->execute();

$s = $pdo->prepare( '
    SELECT * FROM `test_otus` ORDER BY `ts`
' );
$s->execute();
$rows = $s->fetchAll();

echo '<table>';
    echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>TIMESTAMP</th>';
    echo '</tr>';
    foreach ( $rows as $row )
    {
        echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['ts'] . '</td>';
        echo '</tr>';
    }
echo '</table>';