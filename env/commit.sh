#!/bin/sh
cd /var/www/html/
git add .
git commit -m "[CRON] Auto Commit"
git push -u origin
