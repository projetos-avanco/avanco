#!/bin/bash

PATH=/root/.nvm/versions/node/v7.10.0/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games
DIR="/u/apache/chat/lhc_web/avanco/tickets/cron/"
LOG="$DIR/logs/invalida_tickets.log"

mkdir -p $DIR

date >> $LOG
cd $DIR
/usr/bin/php invalida_tickets.php >> $LOG
date >> $LOG

chmod -R 777 $DIR
chown -R www-data.www-data $DIR
