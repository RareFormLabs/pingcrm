#!/bin/bash

# Path to your .env file
ENV_FILE="/home/ploi/pingcrm.rareformlabs.com/.env"

# Load variables from .env file
if [ -f $ENV_FILE ]; then
    export $(grep -v '^#' $ENV_FILE | xargs)
else
    echo "Error: .env file not found at $ENV_FILE"
    exit 1
fi

# Check that required variables are set
if [ -z "$CRAFT_DB_USER" ] || [ -z "$CRAFT_DB_PASSWORD" ] || [ -z "$CRAFT_DB_DATABASE" ]; then
    echo "Error: Required environment variables (CRAFT_DB_USER, CRAFT_DB_PASSWORDD, CRAFT_DB_DATABASE) are missing."
    exit 1
fi

# Path to the backup file
BACKUP_FILE="/home/ploi/pingcrm.rareformlabs.com/db-seed/pingcrm.sql"

# Restore the database
mysql --host=127.0.0.1 -u $CRAFT_DB_USER -p$CRAFT_DB_PASSWORD $CRAFT_DB_DATABASE < $BACKUP_FILE

# Log the reset action
echo "Database reset completed at $(date)" >> /home/ploi/pingcrm.rareformlabs.com/storage/logs/dbreset.log