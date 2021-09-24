<?php

namespace HW9\Models\Traits;

trait Video
{
    private $id_channel = null;

    public function setChannelId(string $id) : void
    {
        $this->id_channel = $id;
    }

    public function getChannelId() : string
    {
        return $this->id_channel;
    }
}
