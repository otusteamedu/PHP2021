# Install
`edit hosts file, add http://hw5.local`

`cd docker && docker compose up`

# Composer

`docker-compose exec php composer install`

# Tests

`docker-compose exec php composer tests`

`OR`

`docker-compose exec php ./vendor/bin/phpunit`

# Lint

`docker-compose exec php ./vendor/bin/phpcs`

`or`

`docker-compose exec composer lint`

# Examples

[Error]

`http://hw5.local/check/email?email=dasdsad2sada@ru`

`http://hw5.local/check/emails?emails[]=dasdsad2sada@ru&emails[]=111111@email.em`

[Success]

`http://hw5.local/check/email?email=yu2ry@rambler.ru`

`http://hw5.local/check/emails?emails[]=yu2ry@rambler.ru&emails[]=yu2ry@mail.ru`