<?php require_once('vendor/autoload.php');

use App\Application\Adapters\RabbitAdapter;
use App\Infrastructure\ConsumerConsole;
use App\Infrastructure\MailAgent;
use PHPMailer\PHPMailer\PHPMailer;

$rabbitAdapter = new RabbitAdapter();
$consumer = new ConsumerConsole($rabbitAdapter->connection, new MailAgent(new PHPMailer()));

$consumer->runFromQueue('bank_queue');
