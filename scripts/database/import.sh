#!/bin/bash

set -e

CURRENT_SCRIPT_FILENAME=`basename "$0"`
CURRENT_SCRIPT_PATH="$( cd "$(dirname "$0")" ; pwd -P )"

source ${CURRENT_SCRIPT_PATH}/_import_dot_env.sh

while getopts d:u:p:h:s:P: option
do
 case "${option}"
 in
 d) DB_DATABASE=${OPTARG};;
 u) DB_USERNAME=${OPTARG};;
 p) DB_PASSWORD=${OPTARG};;
 h) DB_HOST=${OPTARG};;
 P) DB_PORT=${OPTARG};;
 s) DUMP_DIR=${OPTARG};;
 esac
done

if [[ -z "$DUMP_DIR" ]]; then
    PROJECT_ROOT=$(dirname $(dirname "$CURRENT_SCRIPT_PATH"))
    DUMP_DIR=$PROJECT_ROOT/.docker/mysql/config/initdb
fi

echo "$(date) ▆▆▆▆▆ Now running the script ${CURRENT_SCRIPT_FILENAME} as ${USER} "
echo "$(date) ▆▆▆▆▆ Importing database ($DB_DATABASE): mysql://$DB_USERNAME@$DB_HOST"
echo ""

COMPRESSED_DUMP_FILEPATH=${DUMP_DIR}/${DB_DATABASE:-dump}.sql.gz
UNCOMPRESSED_DUMP_FILEPATH=${DUMP_DIR}/${DB_DATABASE:-dump}.sql

echo "$(date)  ┌── DB update: unpacking dump from .gz archive"
gunzip --force --keep ${COMPRESSED_DUMP_FILEPATH}
echo "$(date)  └────── DONE! Filesize is" `du ${UNCOMPRESSED_DUMP_FILEPATH} --human-readable | cut -f1`
echo ""

echo "$(date)  ┌── DB update: dropping existing DB (if any)"
mysql --host=${DB_HOST} --port=${DB_PORT} --user=${DB_USERNAME} --password=${DB_PASSWORD} -e "DROP DATABASE IF EXISTS $DB_DATABASE" # assumes that mysql installed (can fail on app server (production or staging) where we may not have it)
echo "$(date)  └────── DONE!"
echo ""

echo "$(date)  ┌── DB update: creating a new empty DB"
mysql --host=${DB_HOST} --port=${DB_PORT} --user=${DB_USERNAME} --password=${DB_PASSWORD} -e "CREATE DATABASE $DB_DATABASE DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci"
echo "$(date)  └────── DONE!"
echo ""

echo "$(date)  ┌── DB update: importing DB data from a dump (≈20mins on SSD) 🕒"
mysql --host=${DB_HOST} --port=${DB_PORT} --user=${DB_USERNAME} --password=${DB_PASSWORD} ${DB_DATABASE} --default-character-set utf8mb4 --binary-mode < ${UNCOMPRESSED_DUMP_FILEPATH}
echo "$(date)  └────── DONE!"
echo ""

echo "$(date)  ┌── DB dump: removing unpacked DB dump"
rm -f ${UNCOMPRESSED_DUMP_FILEPATH}
echo "$(date)  └────── DONE!"
echo ""
echo "$(date)  Note, you still have a packed dump at the ${COMPRESSED_DUMP_FILEPATH} path."

printf "\n\n"
echo "$(date)  🚀 DB is ready to use!"

echo "$(date) ▆▆▆▆▆ Execution of ${CURRENT_SCRIPT_FILENAME} is completed! "
