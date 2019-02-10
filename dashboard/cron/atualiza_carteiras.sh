#!/bin/bash

PATH=/root/.nvm/versions/node/v7.10.0/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games
DIR="/u/apache/chat/lhc_web/avanco/dashboard/cron/"
LOG="$DIR/logs/atualiza_carteiras.log"

mkdir -p $DIR

date >> $LOG
cd $DIR
/usr/bin/php atualiza_carteiras.php >> $LOG
date >> $LOG

chmod -R 777 $DIR
chown -R www-data.www-data $DIR
