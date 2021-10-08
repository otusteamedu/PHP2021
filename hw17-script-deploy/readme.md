## создать дроплет на https://cloud.digitalocean.com/
```
ubuntu-s-4vcpu-8gb-intel-fra1-01
FRA1 / 8GB / 160GB Disk

46.101.131.175
```

## подключиться по ssh
```shell
ssh root@46.101.131.175
```

## creare workspace
```shell
# create user
USERNICK=deployuser
adduser $USERNICK #password=123
usermod -aG sudo $USERNICK

USERNICK=deployuser
su $USERNICK
cd ~

# todo: сделать так, чтобы этим пользователем можно было зайти по ssh

# install soft

## docker
###--- save script from https://get.docker.com/ in get-docker-com.sh
nano get-docker-com.sh
sudo chmod +x get-docker-com.sh
./get-docker-com.sh
sudo groupadd docker
sudo usermod -aG docker $USER
newgrp docker
# docker run hello-world

## docker-compose
sudo apt install docker-compose -y

## git
sudo apt install git -y


# поднять ларадок
LARADOCK_DIR=otus-laradock
git clone https://github.com/laradock/laradock.git $LARADOCK_DIR
cd $LARADOCK_DIR
cp .env.example .env

cd ~
mkdir -p project/public
echo 'project/public/index.php' >> project/public/index.php

LARADOCK_DIR=otus-laradock
cd $LARADOCK_DIR
sed -i 's@APP_CODE_PATH_HOST=@APP_CODE_PATH_HOST=../project/@' .env
sed -i 's@PHP_VERSION=@PHP_VERSION=7.4@' .env
docker-compose up -d nginx postgres

#cd ~
#nano index.php
#mkdir public
#cp index.php public/index.php
#rm index.php 
#можно тестить в браузере: 46.101.131.175







# настроим базовй брэндмаузер
ufw app list
ufw allow OpenSSH
ufw enable -y
ufw status
#>> Firewall is active and enabled on system startup
ufw disable # пришлось вырубить, ибо база не коннектилась со шторма

# from SCRIPT.md for lesson 32
su githubuser
sudo apt update

sudo apt install curl git unzip nginx postgresql postgresql-contrib rabbitmq-server supervisor \
php-cli php-fpm php-json php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-pear php-bcmath \
php-pgsql -y

exit # switch to root
curl -sS https://getcomposer.org/installer -o composer-setup.php

su githubuser

sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

#exit # switch to root
# !!! везде ответ: could not change directory to "/root": Permission denied 
# solution: cd
sudo -u postgres bash -c "psql -c \"CREATE DATABASE twitter ENCODING 'UTF8' TEMPLATE = template0\""
sudo -u postgres bash -c "psql -c \"CREATE USER my_user WITH PASSWORD '1H8a61ceQW7htGRE6iVz'\""
sudo -u postgres bash -c "psql -c \"GRANT ALL PRIVILEGES ON DATABASE twitter TO my_user\""

sudo apt install mc
#mcedit /etc/postgresql/12/main/pg_hba.conf
sudo -u postgres bash -c "mcedit /etc/postgresql/12/main/pg_hba.conf"
#> host    all<--->        all             0.0.0.0/0               md5
#> host    all<--->        all             ::/0                    md5

#mcedit /etc/postgresql/12/main/postgresql.conf
sudo -u postgres bash -c "mcedit /etc/postgresql/12/main/postgresql.conf"
# listen_addresses='*'
sudo service postgresql restart


sudo rabbitmq-plugins enable rabbitmq_management 
sudo rabbitmq-plugins enable rabbitmq_consistent_hash_exchange
sudo rabbitmqctl add_user my_user T1y04lWk167MkyEK3YFk
sudo rabbitmqctl set_user_tags my_user administrator
sudo rabbitmqctl set_permissions -p / my_user ".*" ".*" ".*"

```
