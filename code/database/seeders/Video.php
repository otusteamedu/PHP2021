<?php

namespace Database\Seeders;

use Database\Factories\VideoFactory;
use Illuminate\Database\Seeder;

class Video extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoFactory::factoryForModel(\App\Models\Video::class)->count(1000);
    }
}
