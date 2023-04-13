<?php

use App\Application;

require_once('vendor/autoload.php');

try {
    $app = new Application();

    if(isset($_GET['action'])) {

        switch ($_GET['action']) {
            case 'top':
                require_once('view/top.php');

                break;

            case 'delete':
                $result['data'] = $app->getAllEsEntitys();

                if($_GET['id'] && $_GET['index']) {
                    $deleteResult = $app->delete($_GET);

                    if($deleteResult['result'] === 'deleted') {
                        require_once('view/delete.php');
                    }
                } else {
                    require_once('view/delete.php');
                }
        }
    } else {
        $result = $app->run();

        switch ($result['action']) {
            case 'created':
                require_once ('view/add.php');

                break;
            case 'search':
                unset($result['action']);
                require_once('view/search-channel.php');

                break;

            case 'search-video':
                require_once('view/search-video.php');

                break;

            case 'delete':
                require_once('view/delete.php');

                break;
        }
    }
}
catch(Exception $e) {
    App\Response::generateBadRequestResponse($e->getMessage());
}
