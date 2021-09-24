<?php

namespace App\Repositories\Info;

use App\Models\Info;

class InfoEloquentRepository implements IInfoRepository
{
    private Info $info;

    public function __construct()
    {
        $this->info = new Info();
    }

    public function create(string $message): Info
    {
        return $this->info->create([
            'message' => $message,
            'status' => 'created',
        ]);
    }

    public function update(Info $info, string $status): Info
    {
        $this->info = $info;
        $this->info->status = $status;
        $this->info->save();

        return $this->info;
    }

    public function getById(int $id): Info
    {
        return $this->info->find($id);
    }
}
