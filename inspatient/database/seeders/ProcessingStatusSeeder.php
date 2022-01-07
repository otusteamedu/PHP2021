<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('processing_statuses')->insert(
            array('code' => 'open',
                'status' => 'Принято в обработку'
            )
        );

        DB::table('processing_statuses')->insert(
            array('code' => 'working',
                'status' => 'В работе'
            )
        );

        DB::table('processing_statuses')->insert(
            array('code' => 'error',
                'status' => 'Произошла ошибка'
            )
        );

        DB::table('processing_statuses')->insert(
            array('code' => 'done',
                'status' => 'Успешно импортирован'
            )
        );

        DB::table('processing_statuses')->insert(
            array('code' => 'importFromEmail',
                'status' => 'Добавлено из почты'
            )
        );

    }
}
