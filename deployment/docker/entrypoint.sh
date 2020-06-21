#!/bin/bash

sh /local/tomcat/bin/startup.sh
service mysql restart
/usr/sbin/apache2ctl -D FOREGROUND
service apache2 restart