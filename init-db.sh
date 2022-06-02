#!/bin/bash

if [[ $# != 4 ]] ; then
	echo "Usage: $0 db_host db_username db_password db_name"
    exit
fi

echo "Creating secret.php file..."

SECRET_FILE=php/secret.php
touch ${SECRET_FILE}

echo "<?php" > ${SECRET_FILE}
echo "\$db_host='$1';" >> ${SECRET_FILE}
echo "\$db_username='$2';" >> ${SECRET_FILE}
echo "\$db_password='$3';" >> ${SECRET_FILE}
echo "\$db_name='$4';" >> ${SECRET_FILE}

echo "Adding database '$4'..."

if [ -d "/opt/lampp" ] ; then
    # if in linux
    sudo mkdir /opt/lampp/var/mysql/$4
    sudo chmod -R a+rwx /opt/lampp/var/mysql/$4
elif [ -d "/mnt/c/xampp/" ] ; then
    # if in windows
    sudo mkdir /mnt/c/xampp/mysql/data/$4
    sudo chmod -R a+rwx /mnt/c/xampp/mysql/data/$4
else
    echo "Couldn't find xampp. Database not added."
    exit
fi

echo "Adding tables:"

response=$(curl -sX GET localhost:80/php/setup-db.php)
eol=$'\n'
response="${response//<br>/$eol}"
echo "$response"