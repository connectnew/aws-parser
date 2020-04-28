Please update your docker and docker-compose to latest version.
````
chmod 777 -R storage

docker-compose build 
docker-compose up -d

docker exec -it parser-aws_php bash
composer install
php index.php
exit

````