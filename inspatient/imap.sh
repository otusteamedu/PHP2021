sudo -u www-data sed -i -- "s|%IMAP_HOST%|$1|g" .env
sudo -u www-data sed -i -- "s|%IMAP_USERNAME%|$2|g" .env
sudo -u www-data sed -i -- "s|%IMAP_PASSWORD%|$3|g" .env