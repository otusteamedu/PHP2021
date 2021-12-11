# PHP2021

## Браузерное приложение и балансировщик

### Запуск приложения
Выполнить HTTP запрос вида
```
POST http://application.local/index.php
Content-Type: multipart/form-data

string:<value>
```     
где `<value>` – параметр, проверяемый на непустоту и корректность кол-ва открытых и закрытых скобок

Пример запроса:  
```
POST http://application.local/index.php
Content-Type: multipart/form-data

string:()()()()()(((()()()))(()(()()(((()))))))
```

Пример ответа:   
```html
{
    String validation completed successfully!
}
```

### Балансировщик
`balancer` распределяет запросы на `webserver1` и `webserver2`, к каждому из которых подключены контейнеры с приложением `app1` и `app2`. Метод балансировки - round_robin.

### Хранение сессий
Сессии сохраняются в `memcached1` и реплицируются в `memcached2`. При потере данных в `memcached1` осуществляется их автоматическое восстановление из `memcached2`.
