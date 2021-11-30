<?php

namespace Database\Factories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'likes' => random_int(1, 1000),
            'dislikes' => random_int(1, 1000),
            'channel_id' => Channel::all()->random()
        ];
    }
}
