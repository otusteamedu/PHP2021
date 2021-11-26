<?php

namespace App\Http\Controllers;

use App\Services\RowGateway\PatientRow;
use PDO;

class PatientRowGateway extends Controller
{

    public function __invoke()
    {
        $host = env('DB_HOST', 'mysql');
        $port = env('DB_PORT', '3306');
        $dbname = env('DB_DATABASE', 'default');

        $username = env('DB_USERNAME', 'default');
        $password = env('DB_PASSWORD', 'secret');
        $PDO = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

        $patient = new PatientRow($PDO);
        $patient->setName('test');
        $patient->setPhone('test');
        $patient->setEmail('test@test.test');

        $id = $patient->insert();
        echo 'Patient add id='.$id.'<br>';
        $patient->delete($id);
        echo 'Patient deleted';
    }

}