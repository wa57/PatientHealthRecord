#!/bin/bash
mysql --user="root" --password="UrTooSlow5!" --database="$database" --execute="source /var/www/html/sql/InitializeDBAndTables.sql"
/usr/bin/php /var/www/html/env/create-appointments.php