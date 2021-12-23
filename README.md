# PHP Developer. Professional


## Урок 3. Внутреннее устройство PHP
https://otus.ru/lessons/razrabotchik-php/?utm_source=github&utm_medium=free&utm_campaign=otus

### Домашнее задание
Чат на сокетах

Цель:
Учимся писать приложения и работать с новыми для себя технологиями.

Консольный чат на сокетах
Создать логику, размещаемую в двух php-контейнерах (server и client), объединённых общим volume.
Скрипты запускаются в режиме прослушивания STDIN и обмениваются друг с другом вводимыми сообщениями через unix-сокеты.

сервер поднимается всегда первым
клиент ожидает ввод из STDIN и отправляет сообщения серверу
сервер выводит полученное сообщение в STDOUT и отправляет клиенту подтверждение (например, "Received 24 bytes")
клиент выводит полученное подтверждение в STDOUT и начинает новую итерацию цикла
Критерии оценки:
Конструкции @ и die неприемлемы. Вместо них используйте исключения

Принимается только Unix-сокет

Код здесь и далее мы пишем с применением ООП

Код здесь и далее должен быть конфигурируем через файлы настроек типа config.ini

Обратите внимание на паттерн FrontController (он же - единая точка доступа). Все приложения, которые Вы создаёте здесь и далее должны вызываться через один файл index.php, в котором есть ТОЛЬКО

Точка входа - app.php

Сервер и клиент запускаются командами

php app.php server
php app.php client

В app.php только строки
require_once('/path/to/composer/autoload.php');

try {
$app = new App();
$app->run();
}
catch(Exception $e){
}

Логика чтения конфигураций и работы с сокетами - только в классах.