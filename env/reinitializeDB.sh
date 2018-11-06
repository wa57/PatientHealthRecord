#!/bin/bash
mysql --user="root" --password="UrTooSlow5!" --database="PatientHealthRecord" --execute="source /var/www/html/sql/InitializeDBAndTables.sql"
mysql --user="root" --password="UrTooSlow5!" --database="PatientHealthRecord" --execute="source /var/www/html/sql/InitializeData.sql"
mysql --user="root" --password="UrTooSlow5!" --database="PatientHealthRecord" --execute="source /var/www/html/sql/InitializeData2.sql"
#/usr/bin/php /var/www/html/env/create-appointments.php