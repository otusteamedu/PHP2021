<?php

namespace Database\Seeders;

use App\Models\Filial;
use Illuminate\Database\Seeder;

class FilialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filial::factory()->count(10)->create();
    }
}
