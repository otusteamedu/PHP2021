<?php

namespace Database\Seeders;

use Database\Factories\ChannelFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Channel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('channels')->truncate();
        \App\Models\Channel::factory(10)->create();
    }
}
