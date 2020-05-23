#!/bin/bash

#Run composer to install libs
#cd /local/home/relis/public_html && composer install
#cd /local/home/relis/public_html && cp --no-clobber .env_dist .env


service mysql restart
/usr/sbin/apache2ctl -D FOREGROUND
service apache2 restart