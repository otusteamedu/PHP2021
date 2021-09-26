<?php

namespace App\Repositories\Info;

use App\Models\Info;

interface IInfoRepository
{
    public function create(string $message): Info;
    public function update(Info $info, string $status): Info;
    public function getById(int $id): Info;
}
