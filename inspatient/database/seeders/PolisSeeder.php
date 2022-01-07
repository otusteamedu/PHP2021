<?php

namespace Database\Seeders;

use App\Models\Polis;
use Illuminate\Database\Seeder;

class PolisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Polis::factory()->count(100)->create();
    }
}
