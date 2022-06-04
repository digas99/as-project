#!/bin/bash

# check if db-config json file exists
if [ ! -f db-config.json ] ; then
    echo "Missing file 'db-config.json'"
    exit
fi

fetch_json () {
    formatted_key="\"$1\""
    local result=$(grep -o ''$formatted_key': "[^"]*' db-config.json | grep -o '[^"]*$')
    echo $result
}

HOST=$(fetch_json host)
USERNAME=$(fetch_json username)
PASSWORD=$(fetch_json password)
NAME=$(fetch_json name)

DB_SIZE=$(fetch_json db_size)

# check if db already exists
if [ -d "/opt/lampp/var/mysql/$NAME" ] || [ -d "/mnt/c/xampp/mysql/data/$NAME" ] ; then
    read -p "Database '$NAME' already exists. Drop it? [Y/n] "
    if [[ $REPLY =~ ^[Yy]$ ]] || [[ $REPLY == '' ]] ; then
        response=$(curl -sX GET localhost:80/php/drop-db.php\?db_host=$HOST\&db_username=$USERNAME\&db_password=$PASSWORD\&db_name=$NAME)
        eol=$'\n'
        response="${response//<br>/$eol}"
        echo "$response"
    else
        exit 1
    fi
fi

echo "Creating secret.php file..."

SECRET_FILE=php/secret.php
touch ${SECRET_FILE}

echo "<?php" > ${SECRET_FILE}
echo "\$db_host='$HOST';" >> ${SECRET_FILE}
echo "\$db_username='$USERNAME';" >> ${SECRET_FILE}
echo "\$db_password='$PASSWORD';" >> ${SECRET_FILE}
echo "\$db_name='$NAME';" >> ${SECRET_FILE}

echo "Adding database '$NAME'..."

if [ -d "/opt/lampp" ] ; then
    # if in linux
    sudo mkdir /opt/lampp/var/mysql/$NAME
    sudo chmod -R a+rwx /opt/lampp/var/mysql/$NAME
elif [ -d "/mnt/c/xampp/" ] ; then
    # if in windows
    sudo mkdir /mnt/c/xampp/mysql/data/$NAME
    sudo chmod -R a+rwx /mnt/c/xampp/mysql/data/$NAME
else
    echo "Couldn't find xampp. Database not added."
    exit
fi

echo "Generating random data..."

response=$(curl -sX GET localhost:80/php/setup-db\?size=$DB_SIZE)
eol=$'\n'
response="${response//<br>/$eol}"
echo "$response"