# Settings
add host http://otus_balancer.local in /etc/hosts file
# RUN
docker-compose up -d

# Usage
GET and POST with param `string`

# Example

GET `Success` GET http://otus_balancer.local/?string=(()()()())((((()()()))))(((())))()

GET `Erorr` http://otus_balancer.local/?string=(()()()()))((((()()()))(()()()(((()))))))


