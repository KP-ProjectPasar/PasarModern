@echo off
REM ========================================
REM Auto Price Update Cron Job
REM Update harga komoditas setiap pagi jam 6:00
REM ========================================

echo [%date% %time%] Starting auto price update...

REM Change to project directory
cd /d "C:\Users\Yongky\OneDrive\Documents\PasarModern"

REM Run the price update command
php spark harga:update-auto

REM Log the execution
echo [%date% %time%] Auto price update completed >> "logs\cron_harga_update.log"

REM Optional: Send notification (if you have email service)
REM echo Price update completed | mail -s "Daily Price Update" admin@example.com

echo [%date% %time%] Auto price update completed successfully!
pause
