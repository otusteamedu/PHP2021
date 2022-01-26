<?php
declare(strict_types=1);

namespace App;

use App\Infrastructure\Controllers\OrderController;

class App
{
    private string $fileJson;


    /**
     * @return string
     */
    public function getFileJson(): string
    {
        return $this->fileJson;
    }

    /**
     * @param string $fileJson
     */
    public function setFileJson(string $fileJson): void
    {
        $this->fileJson = $fileJson;
    }


    public function run():void
    {
        //require_once(ROOT.'src/Infrastructure/Views/index.php');
        (new OrderController())->actionTransactionAPI($this->getFileJson());
    }

}