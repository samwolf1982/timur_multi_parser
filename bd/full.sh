#!/usr/bin/env bash
1 3 * * *              /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 500 1
1 3 * * * sleep 5;     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 499
1 3 * * * sleep 10;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 498



15  3 * * * sleep 0.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
15  3 * * * sleep 0.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
