<?php
declare(strict_types=1);

namespace App\Infrastructure\Controllers;

use App\Infrastructure\Components\DataValidation;
use App\Infrastructure\Services\SendRabbitMQ;
use Exception;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class HomeController
{
    public function actionIndex(): bool
    {
        if (!empty($_POST)) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $dateFrom = $_POST['dateFrom'];
            $dateTo = $_POST['dateTo'];

            if ($_POST['form-id'] === 'form-contact') {
                try {
                    $validation = new DataValidation();
                    $result = $validation->validate();
                    (new SendRabbitMQ())->execute(json_encode($_POST));
                    header("Location:/result");
                } catch (Exception $e) {
                    var_dump($e->getMessage());
                    header("Location:/");
                }
            }
        }
        require_once($_SERVER['DOCUMENT_ROOT']."/src/Infrastructure/Views/index.php");

        return true;
    }

}