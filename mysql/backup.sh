#!/usr/bin/env bash
docker exec -i db mysqldump -hlocalhost -uroot -ptest wordpress > wp_backup.sql