#!/bin/bash

if [[ $# != 4 ]] ; then
	echo "Usage: $0 db_host db_username db_password db_name"
    exit
fi

echo ""; echo "Creating secret.php file..."

SECRET_FILE=php/secret.php
touch ${SECRET_FILE}

echo "<?php" > ${SECRET_FILE}
echo "\$db_host='$1';" >> ${SECRET_FILE}
echo "\$db_username='$2';" >> ${SECRET_FILE}
echo "\$db_password='$3';" >> ${SECRET_FILE}
echo "\$db_name='$4';" >> ${SECRET_FILE}