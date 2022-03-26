<?php
declare(strict_types=1);

namespace App;

use App\Source\Result;

class App
{
    private int $param1;
    private int $param2;

    public function __construct()
    {
        $this->param1 = (int) $_REQUEST['param1'];
        $this->param2 = (int) $_REQUEST['param2'];
    }

    public function run(): void
    {
        $result = new Result();

        $result->run($this->param1, $this->param2);

    }
}