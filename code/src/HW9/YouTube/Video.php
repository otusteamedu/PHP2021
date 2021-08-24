<?php

namespace HW9\YouTube;

use Exception;

Class Video extends Channel
{
    private $id_channel = null;

    public function __construct( string $id )
    {
        $this->id = $id;
    }

    public function setChannelId( string $id ) : void
    {
        $this->id_channel = $id;
    }

    public function getChannelId() : string
    {
        return $this->id_channel;
    }
}

