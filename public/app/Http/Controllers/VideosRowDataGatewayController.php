<?php

namespace App\Http\Controllers;

use App\Services\RowDataGateway\VideosRow;
use PDO;

class VideosRowDataGatewayController extends Controller
{
    public function __invoke()
    {
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $dbname = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        $PDO = new PDO("mysql:host=$host;port=$port;dbname=$dbname",$username,$password);

        $videos = new VideosRow($PDO);
        $videos->setName('test');
        $videos->addLike();
        $videos->addDislikes();
        $videos->setChannelsId(5);
        $videos->setId(1);
    }
}
