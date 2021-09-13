<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ReportTypesSeeder
 * @package Database\Seeders
 */
class ReportTypesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeders/seeds/report_types.sql');

        DB::statement('TRUNCATE `report_types`');

        DB::statement($sql);
    }
}
