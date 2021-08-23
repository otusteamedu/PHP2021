<?php


namespace Tests;

use MySite\app\Services\EventService;
use MySite\app\Support\Entities\Event;

/**
 * ./vendor/bin/phpunit --testdox ./tests/EventTest.php
 *
 * Class EventTest
 * @package Tests
 */
class EventTest extends BaseTest
{

    private const EVENT = '{"priority":1000,"conditions":{"param1":1,"param2":2},"event":"event1"}';

    private const KEY = 'param1:1:param2:2';

    /**
     * @var EventService
     */
    private EventService $eventService;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->eventService = new EventService();
        parent::__construct($name, $data, $dataName);
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testCreateEventObject  ./tests/EventTest.php
     */
    public function testCreateEventObject()
    {
        $event = Event::fromJson(self::EVENT);

        $this->assertEquals(self::KEY, $event->getKey());
        $this->assertEquals('event1', $event->getName());
        $this->assertEquals(1000, $event->getPriority());
    }


    /**
     * ./vendor/bin/phpunit --testdox --filter testSaveEvent  ./tests/EventTest.php
     */
    public function testSaveEvent()
    {
        $event = Event::fromJson(self::EVENT);
        $saved = $this->eventService->addEvent($event);
        $this->assertTrue($saved);
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testGetEvent  ./tests/EventTest.php
     */
    public function testGetEvent()
    {
        $result = $this->eventService->findEvent(self::KEY);
        $this->assertInstanceOf(Event::class, $result);
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testDeleteEvent  ./tests/EventTest.php
     */
    public function testDeleteEvent()
    {
        $event = Event::fromJson(self::EVENT);
        $this->assertTrue(
            $this->eventService->deleteEvent($event)
        );
    }

}
