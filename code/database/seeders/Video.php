<?php

namespace Database\Seeders;

use Database\Factories\VideoFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Video extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->truncate();
        \App\Models\Video::factory(10)->create();
    }
}
