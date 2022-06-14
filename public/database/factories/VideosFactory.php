<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name,
            'channels_id'   => Channel::all()->random(),
            'likes'         => random_int(1,100000),
            'dislikes'      => random_int(1,10000)
        ];
    }
}
