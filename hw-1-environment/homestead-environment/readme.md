```
# cd hw-1-environment/homestead-environment

git clone https://github.com/laravel/homestead.git homestead

cd homestead

git checkout release

cp Homestead.yaml.example Homestead.yaml

# add record to /etc/hosts
sudo bash -c "echo \"192.168.40.2   application-homestead.local\" >> /etc/hosts"

vagrant up

vagrant ssh

# >>
cd code
composer install
```
