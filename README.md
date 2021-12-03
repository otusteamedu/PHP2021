#### - выполнить git clone  https://github.com/laradock/laradock.git 

#### - переименовать .env.example в .env и положиить его в laradock

#### - перейти в laradock и запустить
````
docker-compose up php-fpm nginx mysql elasticsearch kibana workspace
````

/code/app/http/controllers/StatisticController.php - контроллер статистики
/code/app/observers - наблюдатель за моделями, для обновления хранилища ES
/code/app/models модели бд
/code/routes/web.php роуты для статистики
/code/database/migrations миграции с видео и каналами
/code/database/seeds сиды для таблиц видео и каналов
/code/app/repositories репозиторий для работы с ES хранилищем


