<?php

namespace tests;

use App\Services\Events\EventService;

class EventsTest extends \TestCase
{

    private const TEST_EVENTS = [
        [
            'priority' => 1000,
            'conditions' => [
                'param1' => 1,
            ],
            'event' => 'event1'
        ],
        [
            'priority' => 2000,
            'conditions' => [
                'param1' => 2,
                'param2' => 2,
            ],
            'event' => 'event2'
        ],
        [
            'priority' => 3000,
            'conditions' => [
                'param1' => 1,
                'param2' => 2,
            ],
            'event' => 'event3'
        ],
    ];

    private const TEST_REQUEST = [
        'params' => [
            'param1' => 1,
            'param2' => 2,
        ],
    ];

    private const RIGHT_ANSWER = 'event3';

    private EventService $eventService;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->eventService = $this->app->make('App\Services\Events\EventService');
    }

    public function testAddEvent()
    {
        //Чистим данные
        $this->eventService->clearData();

        //Заполняем тестовыми значениями
        foreach (self::TEST_EVENTS as $event) {
            $this->eventService->addEvent($event);
        }

        //Найденное событие
        $returnEvent = $this->eventService->findEventByParams(self::TEST_REQUEST);

        $this->assertEquals(self::RIGHT_ANSWER, $returnEvent);

        //Чистим данные опять от наших тестовых значений
        $this->eventService->clearData();
    }

}
