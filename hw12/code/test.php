<?php declare(strict_types=1);

require_once('vendor/autoload.php');

use App\DataMapper\UserMapper;
use App\ActiveRecord\User as ActiveRecordUser;
use App\RowGateway\UserFinder;
use App\TableGateway\User as TableGatewayUser;

$PDO = new PDO('pgsql:host=postgres;dbname=postgres;port=5432', 'postgres', 'secret', [
    PDO::ATTR_EMULATE_PREPARES => FALSE,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$mapper = new UserMapper($PDO);
$mapper->findCollection();

$activeRecordModel = new ActiveRecordUser($PDO);
$activeRecordModel->findCollection();

$rowGatewayModel = new UserFinder($PDO);
$rowGatewayModel->findCollection();

$tableGatewayModel = new TableGatewayUser($PDO);
var_dump($tableGatewayModel->findCollection());