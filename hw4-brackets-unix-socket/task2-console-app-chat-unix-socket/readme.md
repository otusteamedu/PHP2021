```
# Terminal 1
# cd hw4-brackets-unix-socket/task2-console-app-chat-unix-socket/
docker-compose up -d
docker-compose exec php_fpm_service bash

# >>
composer install
cp src/Repetitor202/Env.php.example src/Repetitor202/Env.php

cd public
php index.php server

# Terminal 2
# cd hw4-brackets-unix-socket/task2-console-app-chat-unix-socket/
docker-compose exec php_fpm_service bash

cd public
php index.php client

```
