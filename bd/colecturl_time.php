<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 7/23/17
 * Time: 2:08 AM
 */


$file = '/home/sam/sites/l18yii/bd/colecturl.txt';




$i=10;

$hour=00;
$min=10;
$itm=100;
$low=50;
$res_string="";
$res_string.= "{$min} {$hour} * * * sleep 0.01;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam {$itm} 1".PHP_EOL;
foreach (range($itm,$low) as $item) {
    $i+=5;
  $res_string.= "{$min} {$hour} * * * sleep {$i};    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam {$item}".PHP_EOL;

}
file_put_contents($file, $res_string,  LOCK_EX);

echo "ok".PHP_EOL;