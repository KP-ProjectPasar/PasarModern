#!/bin/bash

# ========================================
# Auto Price Update Cron Job
# Update harga komoditas setiap pagi jam 6:00
# ========================================

# Set timezone
export TZ=Asia/Jakarta

# Get current timestamp
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')

echo "[$TIMESTAMP] Starting auto price update..."

# Change to project directory
cd /path/to/your/project/PasarModern

# Run the price update command
php spark harga:update-auto

# Log the execution
echo "[$TIMESTAMP] Auto price update completed" >> logs/cron_harga_update.log

# Optional: Send notification via email
# echo "Price update completed at $TIMESTAMP" | mail -s "Daily Price Update" admin@example.com

# Optional: Send notification via Slack/Telegram webhook
# curl -X POST -H 'Content-type: application/json' \
#   --data "{\"text\":\"Daily price update completed at $TIMESTAMP\"}" \
#   https://hooks.slack.com/services/YOUR_WEBHOOK_URL

echo "[$TIMESTAMP] Auto price update completed successfully!"
