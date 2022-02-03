<?php

define('HOST', 'rabbitmq');
define('PORT',  5672);
define('USER', 'user');
define('PASS', 'password');
define('VHOST', '/');
define('EXHANGE', 'bank_exchange');
define('QUEUE', 'codes');
//define('AMQP_DEBUG', getenv('TEST_AMQP_DEBUG') !== false ? (bool)getenv('TEST_AMQP_DEBUG') : false);