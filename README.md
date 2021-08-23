# PHP2021

Пример сервиса, который сохраняет события в БД Redis.

---
Приложение может:

✓ добавлять новое событие в систему хранения событий

✓ очищать все доступные события

✓ отвечать на запрос пользователя наиболее подходящим событием

✓ использовать для хранения событий redis

---
Тесты:
./vendor/bin/phpunit --testdox ./tests/EventTest.php

PHPUnit 9.5.8 by Sebastian Bergmann and contributors.

Event (Tests\Event)

    ✔ Create event object
    ✔ Save event
    ✔ Get event
    ✔ Delete event

Time: 00:00.006, Memory: 4.00 MB

OK (4 tests, 6 assertions)


./vendor/bin/phpunit --testdox ./tests/MassEventsTest.php

PHPUnit 9.5.8 by Sebastian Bergmann and contributors.

Mass Events (Tests\MassEvents)

    ✔ Mass save
    ✔ Find top by params
    ✔ Get all
    ✔ Delete events

Time: 00:00.010, Memory: 4.00 MB

OK (4 tests, 8 assertions)

