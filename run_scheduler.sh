#!/bin/bash
while true
do
  php /home/simpiikc/wbs/artisan schedule:run >> /dev/null 2>&1
  sleep 60
done
