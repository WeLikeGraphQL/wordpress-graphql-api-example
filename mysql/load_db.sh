#!/bin/bash
echo "use wordpress;" | cat - wp_backup.sql > temp | mv temp wp_backup.sql
docker exec -i db mysql -uroot -ptest < wp_backup.sql