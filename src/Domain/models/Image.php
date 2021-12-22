<?php

namespace App\Models;

use App\Services\MessageImage;
use Intervention\Image\ImageManager;

class Image extends Base
{
    /**
     * Добавление картинки к сообщению
     * @param $file
     */
    public function add($file)
    {
        if (!file_exists($file)) {
            return 0;
        }
        $imageManager = new MessageImage();
        $sql = "SELECT id FROM `micro_blog_messages` WHERE isset_image = 1 ORDER BY id DESC";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        move_uploaded_file ($file, PROJECT_PATH . "/public_html/images/" . $result["id"] . ".jpg");
        $imageManager->watermark(PROJECT_PATH . "/public_html/images/" . $result["id"] . ".jpg");
    }
}