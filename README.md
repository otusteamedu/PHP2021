# Settings
add host http://otus_balancer.local in /etc/hosts file

# RUN
`docker-compose up`

# Composer

`docker exec otus-fpm-node-1 composer install`

# Tests

`docker exec otus-fpm-node-1 composer tests`

`or`

`docker exec otus-fpm-node-1 ./vendor/bin/phpunit`

# Usage
GET and POST with param `string`

# Example

GET `Success` http://otus_balancer.local/check?string=()()()()(((())))((((()))))

GET `Erorr` http://otus_balancer.local/check?string=()()()()(((())))((((())))))


