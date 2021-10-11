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
```

## поднимаем рабочее окружение в облаке
```shell

```