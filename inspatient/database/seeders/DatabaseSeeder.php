<?php

namespace Database\Seeders;

use App\Models\Insurance;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $this->call(InsuranceSeeder::class);
      //  $this->call(ProgramSeeder::class);
        $this->call(FilialSeeder::class);
      //  $this->call(PatientSeeder::class);
      //  $this->call(PolisSeeder::class);
        $this->call(ProcessingStatusSeeder::class);
    }
}
