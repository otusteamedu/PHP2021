# Работа с очередями
##Для запуска программы:
###1. docker-composer up
###2. Создайте конфиг файл на основе amqpconfig-example.php с параметрами подключения к очередями
###3. Отправка уведомления происходит через бот телеграм @dz-minyakovabot
###(В классе App\Infrastructure\Services\ReceiverRabbitMQ можно поменять параметры token и и ваш telegram_admin_id)