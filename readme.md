first terminal
docker-compose build
docker-compose up

second terminal

docker exec -it <server-container-name> bash
cd /tmp/public
php index.php server

third terminal
docker exec -it <client-container-name> bash
cd /tmp/public
php index.php client

type words in client terminal and watch it in server terminal