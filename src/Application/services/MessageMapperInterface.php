<?php

namespace App\Application\Services;

use App\Application\DTO\MessageDTO;
use App\Domain\Models\Message;

interface MessageMapperInterface
{
    public function getAllIdWithImages();

    public function getAll();

    public function add(MessageDTO $message);

    public function delete($id);

    public function getAllById($id);
}