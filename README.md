# PHP2021
##Тестирование функционала
##Добавление события
POST    http://redis.local/add
    'priority' => '10000',
    'event' => 'event1',
    'conditions' => 'param1:param, param2:param'

##Поиск события
POST    http://redis.local/event
    'conditions' => 'param1:param, param2:param'

##Список всех событий
POST    http://redis.local/events/all_events

##Список всех условий

POST    http://redis.local/events/all_conditions

##Удаление всех событий
POST    http://redis.local/del