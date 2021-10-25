### VM
```
git clone https://github.com/laravel/homestead.git ./homestead

cd ./homestead

git checkout release

// macOS / Linux...
bash init.sh

// Windows...
init.bat

cp ../Homestead.yaml Homestead.yaml

// add line '192.168.10.10 application.local' to hosts file

vagrant up
```

### Docker
```
cp .env.example .env

// confugure .env file

// add line '127.0.0.1 mysite.local' to hosts file

docker-compose up 
```
