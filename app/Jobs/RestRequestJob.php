<?php

namespace App\Jobs;

use App\Models\RestRequest;

class RestRequestJob extends Job implements RestRequestInterface
{
    private int $id;

    public function handle()
    {
        //ведем сложные вычесления
        sleep(20);

        //меняем статус запроса

        RestRequest::where('id', $this->getId())->update(['status' => 'Запрос обработан']);


    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


}
