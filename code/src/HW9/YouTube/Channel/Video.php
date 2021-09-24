<?php

namespace HW9\YouTube\Channel;

use HW9\Models\Traits\Video as VideoTrait;

class Video extends Channel
{
    use VideoTrait;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
