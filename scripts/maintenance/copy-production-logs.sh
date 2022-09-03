#!/usr/bin/env bash

# This script aims to copy latest production los in emergency situation
# this is a part of emergency plan, for more details,

USER_AND_HOST_NAME="mateus@junges.dev"
STAGE="production"
SITE_DIR="junges.dev/current"
SITE_NAME="junges.dev"

# A date of the logs can be passed as first parameter (format is '2017-04-26')
# otherwise use current date
logs_date=${1-$(date -u +"%Y-%m-%d")}
CURRENT_SCRIPT_PATH="$( cd "$(dirname "$0")" ; pwd -P )"
TARGET_LOCAL_DIR="$CURRENT_SCRIPT_PATH/../../!copied_logs/$STAGE/$logs_date"

source $CURRENT_SCRIPT_PATH/common-copy.sh
