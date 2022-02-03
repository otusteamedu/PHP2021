<?php

define('HOST', getenv('TEST_RABBITMQ_HOST') ?? 'localhost');
define('PORT', getenv('TEST_RABBITMQ_PORT') ?? 5672);
define('USER', getenv('TEST_RABBITMQ_USER') ?? 'user');
define('PASS', getenv('TEST_RABBITMQ_PASS') ?? 'password');
define('VHOST', '/');
define('AMQP_DEBUG', getenv('TEST_AMQP_DEBUG') !== false ? (bool)getenv('TEST_AMQP_DEBUG') : false);