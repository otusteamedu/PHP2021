<?php
session_start();

if( isset( $_SESSION['counter'] ) ) {
    $_SESSION['counter'] += 1;
}else {
    $_SESSION['counter'] = 1;
}

$msg = "You have visited this page ".  $_SESSION['counter'] . " times in this session.";

echo $msg;
phpinfo();