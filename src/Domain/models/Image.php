<?php

namespace App\Domain\Models;

use App\Application\Services\Config;
use App\Application\Services\MessageImage;

class Image extends Base
{
    /**
     * Добавление картинки к сообщению
     * @param $file
     */
    public function add($file)
    {
        if (!file_exists($file)) {
            throw new \Exception();
        }
        global $app;
        $imageManager = $app->make(MessageImage::class);
        $sql = "SELECT id FROM `messages` WHERE isset_image = 1 ORDER BY id DESC";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        move_uploaded_file ($file, Config::getApp('PROJECT_PATH') . "/public_html/images/" . $result["id"] . ".jpg");
        $imageManager->watermark(Config::getApp('PROJECT_PATH') . "/public_html/images/" . $result["id"] . ".jpg");
    }
}