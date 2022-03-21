<?php
declare(strict_types=1);

$apiVersion = '/api/v1';


$r->addRoute('POST', "$apiVersion/requests", 'Request');
//$r->addRoute('GET', "$apiVersion/requests", 'Request');
// {id} must be a number (\d+)
$r->addRoute('GET', "$apiVersion/requests[/{id:\d+}]", 'Request');

