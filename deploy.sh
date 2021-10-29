sudo apt install curl git unzip ca-certificates gnupg lsb-release


sudo mkdir ~/www/stage/data

sudo cp -pr ~/mysql stage/data

git clone https://deploy:key@gitlab.com ./stage/data/public_html

sudo -u www-root touch stage/.env

sudo -u www-root sed -i -- "s|%DATABASE_ROOT_PASSWORD%|$5|g" .env
sudo -u www-root sed -i -- "s|%DATABASE_HOST%|$2|g" .env
sudo -u www-root sed -i -- "s|%DATABASE_USER%|$3|g" .env
sudo -u www-root sed -i -- "s|%DATABASE_PASSWORD%|$4|g" .env
sudo -u www-root sed -i -- "s|%DATABASE_NAME%|$5|g" .env

sudo -u www-data sed -i -- "s|%APP_ENV%|$5|g" .env

sudo mkdir ~/www/stage/nginx/certs
sudo cp nginx/certs ~/www/stage/nginx/certs -f
sudo cp nginx/stage.conf ~/www/stage/nginx/stage.conf -f

sudo mkdir ~/www/stage/data/

cd ~/www/stage

sudo docker-compose build
sudo docker-compose up

sudo chown www-root:www-root -R ~/www/stage



