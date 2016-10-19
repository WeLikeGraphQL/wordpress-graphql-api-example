#!/bin/bash

# Run this script from the project root folder:
# bash -x scripts/load_db.sh

source .env

if ! grep -Fxq "use ${MYSQL_DB};" scripts/wp_backup.sql
then
  echo "use ${MYSQL_DB};" | cat - scripts/wp_backup.sql > temp | mv temp scripts/wp_backup.sql
fi
docker exec -i db mysql -u${MYSQL_USER} -p${MYSQL_PASSWORD} < scripts/wp_backup.sql

source scripts/add_to_plugin.sh