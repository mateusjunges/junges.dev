#!/bin/bash

set -e

#######################################################
# Read database setup guide before changing this.
# ⚠️ The script intended to be used on PRODUCTION server ONLY.
#######################################################

# Go the backup folder
cd ~/backups

############### Step 1: Setup ##################

# Create variables for current running backup and destination file (name for S3 file)
FULL_BACKUP_LATEST_FILENAME=lastbackup.sql.gz
FULL_BACKUP_IN_PROGRESS_FILENAME=$(date "+%Y%m%d%H%M%S"--full).sql.gz
FULL_BACKUP_UPLOAD_FILENAME=$(date "+%Y%m%d").sql.gz

DEV_BACKUP_LATEST_FILENAME=lastbackup--dev.sql.gz
DEV_BACKUP_IN_PROGRESS_FILENAME=$(date "+%Y%m%d%H%M%S"--dev).sql.gz
DEV_BACKUP_FILENAME_UNZIPPED=$(date "+%Y%m%d%H%M%S"--dev).sql
DEV_BACKUP_VERSION=$(date "+%Y%m%d%H%M%S")
DEV_BACKUP_VERSION_FILENAME=lastbackup--dev.sql.gz.version

# @todo consider using _import_dot_env.sh
DB_DATABASE=forge
DB_USERNAME=forge

S3_BUCKET_NAME=idf--backup

if [ "$(date "+%d")" = "01" ]; then
    S3_SUBDIRECTORY="monthly"
else
    S3_SUBDIRECTORY="daily"
fi

# remove listed tables from minimal backup
EXCLUDED_TABLES_FOR_DEV=(
    action_events
    logging__logs
    leads
    contact_list_subscriber
    download_request
    guest_downloaders
    notification__message_log_email
    notification__message_log_postcard
    notification__message_log_sms
    notification__message_queue_email
    notification__message_queue_postcard
    notification__message_queue_sms
    notification__notification_log
    notification__notification_queue
    session_reference
    jobs--failed
    statistic_value
    memberships__renewal_results
)

TABLES_SHOULD_BE_EXPORTED_AT_THE_END=(
    course__quiz_answers
    payment__transactions
    payment__invoices
    payment__invoice_lines
    payment__invoice_line_discounts
    discussion_member_subscription_v2
    discussion_message_v2
)

IGNORED_TABLES_STRING=''
for TABLE in "${EXCLUDED_TABLES_FOR_DEV[@]}"; do
    :
    IGNORED_TABLES_STRING+=" --ignore-table=${DB_DATABASE}.${TABLE}"
done
# ignore also big tables: they will be added at the end
for TABLE in "${TABLES_SHOULD_BE_EXPORTED_AT_THE_END[@]}"; do
    :
    IGNORED_TABLES_STRING+=" --ignore-table=${DB_DATABASE}.${TABLE}"
done

############### Step 2: Create dumps ##################

echo "$(date) -- Creating full DB dump ..."
# Full backup
mysqldump --single-transaction \
    --default-character-set=utf8mb4 \
    -u ${DB_USERNAME} ${DB_DATABASE} -v | gzip >${FULL_BACKUP_IN_PROGRESS_FILENAME}
echo "$(date) -- Full dump created (compressed)!"


echo "$(date) -- Creating dev DB dump ..."
# Developers backup
# - 1) dump structure
mysqldump --single-transaction \
    --default-character-set=utf8mb4 \
    --skip-add-drop-table \
    --no-data \
    -u ${DB_USERNAME} ${DB_DATABASE} -v >>${DEV_BACKUP_FILENAME_UNZIPPED}
echo "$(date) -- Dev DB step 1/2. Schema backed up!"

# - 2) dump required data
mysqldump --single-transaction \
    --default-character-set=utf8mb4 \
    --no-create-info \
    ${IGNORED_TABLES_STRING} \
    -u ${DB_USERNAME} ${DB_DATABASE} -v >>${DEV_BACKUP_FILENAME_UNZIPPED}

# 3) dump optional data from big tables
BIG_TABLES_STRING=''
for TABLE in "${TABLES_SHOULD_BE_EXPORTED_AT_THE_END[@]}"; do
    :
    BIG_TABLES_STRING+=" ${TABLE}"
done

mysqldump --single-transaction \
    --default-character-set=utf8mb4 \
    --no-create-info \
    -u ${DB_USERNAME} ${DB_DATABASE} ${BIG_TABLES_STRING} -v >>${DEV_BACKUP_FILENAME_UNZIPPED}
echo "$(date) -- Dev DB step 2/2. Data from selected DB tables backed up!"
#########

# gzip file content
gzip ${DEV_BACKUP_FILENAME_UNZIPPED}
echo "$(date) -- Dev dump created (compressed)!"

############### Step 3: Update references to latest dumps ##################

echo "$(date) -- Updating references to latest dumps ..."

mv ${FULL_BACKUP_IN_PROGRESS_FILENAME} ${FULL_BACKUP_LATEST_FILENAME}
mv ${DEV_BACKUP_IN_PROGRESS_FILENAME} ${DEV_BACKUP_LATEST_FILENAME}
echo ${DEV_BACKUP_VERSION} >${DEV_BACKUP_VERSION_FILENAME}
echo "$(date) -- References updated!"

############### Step 4: Upload dump to S3 ##################

echo "$(date) -- Uploading full dump to S3 ..."
aws s3 cp ${FULL_BACKUP_LATEST_FILENAME} s3://${S3_BUCKET_NAME}/database/${S3_SUBDIRECTORY}/${FULL_BACKUP_UPLOAD_FILENAME} \
    --content-type application/gzip

# Please note: expirations rules are set on bucket-basis
aws s3api put-object-tagging \
    --bucket ${S3_BUCKET_NAME} \
    --key database/${S3_SUBDIRECTORY}/${FULL_BACKUP_UPLOAD_FILENAME} \
    --tagging "TagSet=[{Key=backup-type,Value=database},{Key=backup-dir,Value=${S3_SUBDIRECTORY}}]"
echo "$(date) -- Uploaded!"

############### Step 5: Upload dev dump to staging server ##################

echo "$(date) -- Uploading dev dump to staging server ..."
scp ${DEV_BACKUP_LATEST_FILENAME} forge@information-architecture.org:/home/forge/backups/
scp ${DEV_BACKUP_VERSION_FILENAME} forge@information-architecture.org:/home/forge/backups/
echo "$(date) -- Uploaded!"

############### Step 6: Final cleanup ##################
# Cleanup directory with any uncompleted backups (if any, normally should not have them)
rm *.sql -f

echo "$(date) -- 🏁 All backup jobs are completed!"

# Example of timing:
# Wed Dec  1 14:43:21 UTC 2021 -- Creating full DB dump ...
# Wed Dec  1 14:56:53 UTC 2021 -- Full dump created (compressed)!
# Wed Dec  1 14:56:53 UTC 2021 -- Creating dev DB dump ...
# Wed Dec  1 14:56:53 UTC 2021 -- Dev DB step 1/2. Schema backed up!
# Wed Dec  1 14:58:17 UTC 2021 -- Dev DB step 2/2. Data from selected DB tables backed up!
# Wed Dec  1 15:01:12 UTC 2021 -- Dev dump created (compressed)!
# Wed Dec  1 15:01:12 UTC 2021 -- Updating references to latest dumps ...
# Wed Dec  1 15:01:12 UTC 2021 -- References updated!
# Wed Dec  1 15:01:12 UTC 2021 -- Uploading full dump to S3 ...
# Wed Dec  1 15:01:55 UTC 2021 -- Uploaded!
# Wed Dec  1 15:01:55 UTC 2021 -- Uploading dev dump to staging server ...
# Wed Dec  1 15:02:05 UTC 2021 -- Uploaded!
# Wed Dec  1 15:02:05 UTC 2021 -- 🏁 All backup jobs are completed!
