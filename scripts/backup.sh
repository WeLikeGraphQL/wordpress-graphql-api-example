#!/usr/bin/env bash
source .env

docker exec -i db mysqldump -h${HOST} -u${MYSQL_USER} -p${MYSQL_PASSWORD} ${MYSQL_DB} > wp_backup.sql