#!/usr/bin/env bash

EXPECTED_CONTENT_OF_EMPTY_FILE=" {}"
DEAD_CSS_FILES="./public/css/*.dead.css"

EXIT_CODE=0

for FILENAME in $DEAD_CSS_FILES
do
  if [[ $(< $FILENAME) != "$EXPECTED_CONTENT_OF_EMPTY_FILE" ]]; then
      echo "Found a dead CSS in $FILENAME. Please remove it or add to whitelist of the 'css:dead' gulp task"
      cat $FILENAME
      echo
      EXIT_CODE=1
  fi
done

exit $EXIT_CODE # terminate and indicate an error or success