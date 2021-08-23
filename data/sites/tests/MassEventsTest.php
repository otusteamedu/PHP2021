<?php


namespace Tests;


use MySite\app\Services\EventService;
use MySite\app\Support\Entities\Event;
use MySite\app\Support\Traits\EventTools;

/**
 * ./vendor/bin/phpunit --testdox ./tests/MassEventsTest.php
 *
 * Class MassEventsTest
 * @package Tests
 */
class MassEventsTest extends BaseTest
{
    use EventTools;

    private const EVENTS = [
        '{"priority": 1000, "conditions": { "param1": 1 }, "event": "event1"}',
        '{"priority": 2000, "conditions": { "param1": 2, "param2": 2 }, "event": "event2"}',
        '{"priority": 3000, "conditions": { "param1": 1, "param2": 2 }, "event": "event3"}'
    ];

    private const QUERY = '{ "params": { "param1" : 1, "param2" : 2 } }';

    /**
     * @var EventService
     */
    private EventService $eventService;

    /**
     * MassEventsTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->eventService = new EventService();
        parent::__construct($name, $data, $dataName);
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testMassSave  ./tests/MassEventsTest.php
     */
    public function testMassSave()
    {
        foreach (self::EVENTS as $event) {
            $event = Event::fromJson($event);
            $this->assertTrue(
                $this->eventService->addEvent($event)
            );
        }
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testFindByQuery  ./tests/MassEventsTest.php
     */
    public function testFindTopByParams()
    {
        $json = json_decode(self::QUERY, true);
        $key = self::createKey($json['params']);
        $topEvent = $this->eventService->findTopEventByConditions($key);
        $this->assertInstanceOf(Event::class, $topEvent);
        $this->assertEquals('event3', $topEvent->getName());
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testGetAll  ./tests/MassEventsTest.php
     */
    public function testGetAll()
    {
        $events = $this->eventService->getAllEvents();
        $iterator = $events->getIterator();
        $this->assertIsIterable($iterator);
        $this->assertCount(3, $iterator);
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testDeleteEvents  ./tests/MassEventsTest.php
     */
    public function testDeleteEvents()
    {
        $this->assertTrue(
            $this->eventService->deleteAllEvents()
        );
    }
}
