<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ReportStatusesSeeder
 * @package Database\Seeders
 */
class ReportStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeders/seeds/report_statuses.sql');

        DB::statement('TRUNCATE `report_statuses`');

        DB::statement($sql);
    }
}
