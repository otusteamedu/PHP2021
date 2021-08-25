# PHP2021
___

Микросервис, который будет записывать данные о заходивших пользователях на определенный эндпоинт ресурса.

На вход будет приходить в формате json, например, сюда

POST /api/endpoint

    {
    "http_referer": "http_referer",
    "query_string": "query_string",
    "redirected_query_string": "redirected_query_string",
    "user_ip": "user_ip",
    "user_agent": "user_agent"
    }

Эти данные запишутся в БД.

___

Использован парттерн DataMapper.
