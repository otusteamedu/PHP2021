# PHP2021

## API

### Запуск приложения

Для запуска сервиса обработки сообщений из очереди выполнить в контейнере `otus-php2021-app` php-скрипт

```
/var/www/application.local# php index.php --type=server
```     

Документация на API: http://application.local/swagger-ui/index.html

Скрипт для генерации актуальной OpenAPI документации

```
./vendor/bin/openapi -o /var/www/application.local/swagger-ui/openapi.yaml /var/www/application.local/src
```   
