#!/bin/bash

set -e

CURRENT_SCRIPT_FILENAME=`basename "$0"`
CURRENT_SCRIPT_PATH="$( cd "$(dirname "$0")" ; pwd -P )"

PROJECT_ROOT=$(dirname $(dirname "$CURRENT_SCRIPT_PATH"))

# Import required DB credentials to create a DB connection
source ${CURRENT_SCRIPT_PATH}/_import_dot_env.sh

echo "$(date) ▆▆▆▆▆ Now running the script ${CURRENT_SCRIPT_FILENAME} as ${USER} "
echo "$(date) ▆▆▆▆▆ Downloading database dump"
echo ""

echo "$(date)  ┌── DB dump: Checking for a new dump ..."
LOCAL_DB_DUMPS_PATH="${PROJECT_ROOT}/.docker/mysql/config/initdb"

LOCAL_DUMP_FILENAME=${DB_DATABASE:-dump}.sql.gz
LOCAL_DUMP_FILEPATH=${LOCAL_DB_DUMPS_PATH}/${LOCAL_DUMP_FILENAME}

LOCAL_VERSION_FILENAME=${DB_DATABASE:-dump}.sql.gz.version.local
LOCAL_VERSION_FILEPATH=${LOCAL_DB_DUMPS_PATH}/${LOCAL_VERSION_FILENAME}

SERVER_DUMP=forge@information-architecture.org:/home/forge/backups/lastbackup--dev.sql.gz
SERVER_VERSION=forge@information-architecture.org:/home/forge/backups/lastbackup--dev.sql.gz.version

# Test SSH connection
# At the first run ~/.ssh/known_hosts can be empty and ask to confirm to connect to unknown develop.information-architecture.org domain
# -oStrictHostKeyChecking=no will handle it, but it produce additional output "Warning..."
set +e # Disable set -e for an individual command
CONNECTION_OUTPUT=$(ssh -o BatchMode=yes -o ConnectTimeout=5 -o StrictHostKeyChecking=no -o LogLevel=error forge@information-architecture.org echo 'connection_established' 2>&1)
EXIT_CODE=$?
set -e
if [[ $CONNECTION_OUTPUT != *"connection_established"* ]]; then
    echo "$CONNECTION_OUTPUT (exit code: $EXIT_CODE)"
    echo "🛑️ Could not connect to staging server. Check https://forge.laravel.com/servers/359885/keys to see if your SSH key is present for the staging server and try again."
    exit $EXIT_CODE # terminate and indicate error
fi;

echo "$(date)  ├────── Connection Established"
echo "$(date)  ├── DB dump: Comparing versions of latest DB dump from server with current one ..."
if [ -f "$LOCAL_VERSION_FILEPATH" ]; then
    LOCAL_DB_DUMP_VERSION=`cat $LOCAL_VERSION_FILEPATH | awk '{ print $1 }'`
else
    LOCAL_DB_DUMP_VERSION=' N/A '
fi;
echo "$(date)  ├────── Client dump version: $LOCAL_DB_DUMP_VERSION"


OLD_VERSION_FILE_FILEPATH="$LOCAL_DUMP_FILEPATH.version.server"

scp -o "StrictHostKeyChecking no" $SERVER_VERSION $OLD_VERSION_FILE_FILEPATH
SERVER_DB_DUMP_VERSION=`cat $OLD_VERSION_FILE_FILEPATH | awk '{ print $1 }'`
rm -f $OLD_VERSION_FILE_FILEPATH
echo "$(date)  ├────── Server dump version: $SERVER_DB_DUMP_VERSION"

if [[ "$SERVER_DB_DUMP_VERSION" = *"Permission denied"* ]]; then
    echo ERROR: Failed to download $SERVER_DB_DUMP_VERSION from staging server. Please ensure that you have added your public SSH key to the server 1>&2
    exit 1 # terminate and indicate error
fi;

# prepare temp/downloading dir
DUMP_DOWNLOADING_LOCAL_PATH="${LOCAL_DB_DUMPS_PATH}--downloading"
mkdir -p ${DUMP_DOWNLOADING_LOCAL_PATH}

if [ "$SERVER_DB_DUMP_VERSION" = "$LOCAL_DB_DUMP_VERSION" ]; then
    echo "$(date)  └────── Result: No updates available"
    echo ""
else
    echo "$(date)  └────── Result: Update available!"
    sleep 2
    echo "$(date)  ┌── DB dump: Downloading fresh DB dump (≈2-60mins) 🕒"
    scp -o "StrictHostKeyChecking no" $SERVER_VERSION $DUMP_DOWNLOADING_LOCAL_PATH/$LOCAL_VERSION_FILENAME
    scp -o "StrictHostKeyChecking no" $SERVER_DUMP $DUMP_DOWNLOADING_LOCAL_PATH/$LOCAL_DUMP_FILENAME
    # move files from temp to permanent dir
    mv $DUMP_DOWNLOADING_LOCAL_PATH/$LOCAL_DUMP_FILENAME $LOCAL_DB_DUMPS_PATH
    mv $DUMP_DOWNLOADING_LOCAL_PATH/$LOCAL_VERSION_FILENAME $LOCAL_DB_DUMPS_PATH

    echo "$(date)  └────── DONE! Dump located at $LOCAL_DB_DUMPS_PATH, filesize is" `du -m ${LOCAL_DUMP_FILEPATH} | cut -f1`Mb
    echo ""
fi;

rm -rf $DUMP_DOWNLOADING_LOCAL_PATH

echo "$(date) ▆▆▆▆▆ Execution of ${CURRENT_SCRIPT_FILENAME} is completed! "
