**Install**

```
$ cd www 
$ composer install
$ cd ..
$ docker-compose up -d
```


**Run server**

```
$ docker-compose exec {server-container-name} php app.php server
```
You should get
```
Socket init...
Socket initialized
Connection init...
New connection ��2 initialized.
Waiting for a message...
```

**Run client**

```
$ docker-compose exec {client-container-name} php app.php client
```
You should get
```
Socket init...
Connection established
Input text message: 
```

Send messages and receive answers from the server.