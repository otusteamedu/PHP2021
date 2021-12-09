<?php

namespace Database\Seeders;

use App\Interfaces\NoSqlRepositoryInterface;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    private $noSqlRepository;

    public function __construct(NoSqlRepositoryInterface $noSqlRepository)
    {
        $this->noSqlRepository = $noSqlRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->noSqlRepository->deleteAllEvents();
        $this->noSqlRepository->addEvent(1000, [
            'param1' => 1
        ], 'event1');
        $this->noSqlRepository->addEvent(2000, [
            'param1' => 2,
            'param2' => 2
        ], 'event2');
        $this->noSqlRepository->addEvent(3000, [
            'param1' => 1,
            'param2' => 2
        ], 'event3');
    }
}
