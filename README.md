## Установка

```shell
$ git clone https://github.com/otusteamedu/PHP2021.git NVasilev/hm3
$ docker-compose up
$ docker exec -it <container_php_fpm_id> bash
$ cd /var/www;
$ php composer.phar install
```

## Запуск сервера

```shell
$ php app.php server 
```

## Запуск клиента

```shell
$ php app.php client 
```
