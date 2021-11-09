### Install
```bash
cp .env.example .env

// confugure .env file

// add line '127.0.0.1 mysite.local' to hosts file

docker-compose up --build -d

docker exec -it app-server bash

cd mysite.local

composer install
```

### Example use

#### Curl
```bash
curl --location --request POST 'http://mysite.local' \
--form 'string="(((()))())"'
```

#### Postman
Create a new POST request to http://mysite.local and add a form-data parameter named "string".