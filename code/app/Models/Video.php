<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, Searchable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function toArray()
    {
        $channel = Channel::find($this->channel_id);
        return [
            'name' => $this->name,
            'likes' => $this->likes,
            'dislikes' => $this->dislikes,
            'channel' => $channel->name,
        ];
    }
}
