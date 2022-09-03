#!/bin/bash

set -e

#####################################################
#                                                   #
#             Import .env vars to shell             #
#                                                   #
#####################################################

CURRENT_SCRIPT_FILENAME=`basename "$0"`
CURRENT_SCRIPT_PATH="$( cd "$(dirname "$0")" ; pwd -P )"

while getopts c:f: option
do
 case "${option}"
 in
 c) DOT_ENV_FILEPATH="$(dirname "$CURRENT_SCRIPT_PATH")/../.env";;
 f) DOT_ENV_FILEPATH=${OPTARG};; # 'f' stands for 'file': you need to provide a path to .env file manually
 esac
done


if [[ -z "$DOT_ENV_FILEPATH" ]]; then
  echo '🛑 Please specify "-f DOT_ENV_FILEPATH" or "-c 1" option to load DB connection vars'
  exit 1;
fi

import_vars_from_env() {
  ENV_FILEPATH=$1

  source $ENV_FILEPATH

  if [[ -z "$APP_ENV" ]]; then
      echo "ERROR: Unknown environment, please check your .env file (it should contain APP_ENV)" 1>&2
      echo "File path: $ENV_FILEPATH" 1>&2
      exit 1 # terminate and indicate error
  fi;
  if [[ "$APP_ENV" = "production" ]]; then
      echo "ERROR: .env export doesn't work on production env for security reasons" 1>&2
      exit 1 # terminate and indicate error
  fi;
}

import_vars_from_env $DOT_ENV_FILEPATH

if [[ -z "$DB_DATABASE" || -z "$DB_USERNAME" || -z "$DB_PASSWORD" || -z "$DB_HOST" ]]; then
    echo '🛑 No credentials to connect to DB'
    echo $ENV_FILEPATH $DB_DATABASE $DB_USERNAME $DB_PASSWORD
    exit 1;
fi
