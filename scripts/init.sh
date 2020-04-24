# 初回は手動で.envを作成する
#!/bin/bash
result=`ps aux | grep artisan | head -n 1`
list=(${result// / })
num=${list[1]}
kill -9 $num
result=`ps aux | grep /usr/bin/php | head -n 1`
list=(${result// / })
num=${list[1]}
kill -9 $num

cd /var/www/rebuilt-api
sudo chown -R root:www /var/www
sudo chmod 2775 /var/www
find /var/www -type d -exec sudo chmod 2775 {} \;
find /var/www -type f -exec sudo chmod 0664 {} \;
sudo chmod -R 777 ./storage
sudo chmod -R 775 ./bootstrap/cache

sudo swapoff -v /var/swap.1
sudo rm -f /var/swap.1
sudo /bin/dd if=/dev/zero of=/var/swap.1 bs=1M count=2048
sudo /sbin/mkswap /var/swap.1
sudo /sbin/swapon /var/swap.1
composer update

php artisan view:cache
php artisan config:cache
composer install --optimize-autoloader --no-dev
php artisan route:cache
# php artisan migrate:refresh --seed

sudo service httpd restart
php artisan serve &
