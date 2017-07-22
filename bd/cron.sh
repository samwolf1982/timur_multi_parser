#!/usr/bin/env bash

12 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23  * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 1
13 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 2
14 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 3
15 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 4
16 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 5
17 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 6
18 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 7
18 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 8
19 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 9
20 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 10
21 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 11
22 01,02,03,03,04,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parserdomria/runparam 12

1 00-23 * * *     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 1 1
1 00-23 * * * sleep 6;     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 2
1 00-23 * * * sleep 12;     /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 3
1 00-23 * * * sleep 18;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 4
1 00-23 * * * sleep 24;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 5
2 00-23 * * * sleep 26;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 6
2 00-23 * * * sleep 6;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 7
2 00-23 * * * sleep 12;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 8
2 00-23 * * * sleep 18;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 9
2 00-23 * * * sleep 24;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam 10



*/3 * * * * sleep 0.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 1;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 1.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 2;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 2.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 3;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 3.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 4;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 4.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 5.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 6;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 6.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 7;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 7.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 8;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 8.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 9;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 * * * * sleep 9.5;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
*/3 00-00 * * * sleep 10;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun
