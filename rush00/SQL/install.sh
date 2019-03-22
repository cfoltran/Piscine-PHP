# This file init the backend environnement
# MySql container, PhpMyAdmin container
#

# create the volume to save database
docker volume create fakir-disk

# create mySql container
docker run -d --restart on-failure -v fakir-disk:/var/lib/mysql \
-e MYSQL_ROOT_PASSWORD=coucou -e MYSQL_DATABASE=db_fakir --name fakirdb mysql:8 \
--default-authentication-plugin=mysql_native_password

# create PhpMyAdmin container
docker run --name phpmyadmin -d --link fakirdb:db -p 3306:80 phpmyadmin/phpmyadmin

