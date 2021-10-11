## создать облако (дроплет - digitalocean), завести ssh ключ для рута

## создать пользователя, которым можно будет ходить по ssh с локальной машины в облако
```shell
ssh-keygen # /home/viktar/.ssh/id_rsa_u3 ..(2)

ssh root@142.93.34.164
# >>
adduser u3 # password=1 .....(5) y
usermod -aG sudo u3
exit

cat ~/.ssh/id_rsa_u3.pub | \
ssh root@142.93.34.164 "mkdir -p /home/u3/.ssh && touch /home/u3/.ssh/authorized_keys && chmod -R go= /home/u3/.ssh && cat >> /home/u3/.ssh/authorized_keys"

ssh root@142.93.34.164
# >>
su u3
cd
sudo chown -R u3:u3 ~/.ssh
exit

# login by new user
# ssh u3@142.93.34.164 # Received disconnect from 142.93.34.164 port 22:2: Too many authentication failures
ssh -i ~/.ssh/id_rsa_u3.pub u3@142.93.34.164

# создадим ssh-private-key для репозиторя (github)
ssh-keygen # /home/u3/.ssh/id_rsa_github ..(2)

# чтобы github-action мог что-то деплоить в облако
cat ~/.ssh/id_rsa_u3.pub ~/.ssh/authorized_keys2
chmod 640 ~/.ssh/authorized_keys2
```

##repository (github)
```
# create secrets 
1 https://github.com/repetitor/autodeploy-u3/settings/secrets/actions
2 Secrets
3 New repository secret 
## HOST=142.93.34.164
## PORT=22
## SSHKEY=%private id_rsa_github%
## USERNAME=u3

p.s. get private key (в облаке):
ssh -i ~/.ssh/id_rsa_u3.pub u3@142.93.34.164
# >>
cat ~/.ssh/id_rsa_github
Ctrl-c Ctrl-v


создаем action (тесты и автодеплой в продакшен): https://github.com/repetitor/autodeploy-u3/tree/main/.github/workflows
```

## поднимаем рабочее окружение в облаке
```shell
ssh -i ~/.ssh/id_rsa_u3.pub u3@142.93.34.164
# >>

# docker
nano get-docker-com.sh # save script from https://get.docker.com/ in get-docker-com.sh
sudo chmod +x get-docker-com.sh
./get-docker-com.sh
sudo groupadd docker
sudo usermod -aG docker $USER
newgrp docker
# docker run hello-world # >> Hello from Docker!

## docker-compose
sudo apt install docker-compose -y

## git
sudo apt install git -y

mkdir project

# laradock
LARADOCK_DIR=otus-laradock
git clone https://github.com/laradock/laradock.git $LARADOCK_DIR
cd $LARADOCK_DIR
cp .env.example .env
sed -i 's@APP_CODE_PATH_HOST=@APP_CODE_PATH_HOST=../project/@' .env
sed -i 's@PHP_VERSION=@PHP_VERSION=7.4@' .env
docker-compose up -d nginx postgres
```


