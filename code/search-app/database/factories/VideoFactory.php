<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $views = rand(50, 1000000);
        $likes = rand(10, $views);
        $dislikes = rand(0, $views - $likes);

        return [
            'name' => 'Video ' . $this->faker->company,
            'link' => $this->faker->unique()->url,
            'channel_id' => rand(1, 10),
            'views' => $views,
            'likes' => $likes,
            'dislikes' => $dislikes,
        ];
    }
}
