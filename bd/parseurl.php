<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 7/23/17
 * Time: 2:08 AM
 */

$file = '/home/sam/sites/l18yii/bd/parseurl.txt';
$i=10;
//$increment = 0.5;
$increment = 1;
$start = 1.0;
$res_str='';
$hour=00;
$min=25;
$res_str.= "{$min}  {$hour} * * * sleep 0.05;    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun".PHP_EOL;
foreach (range(0,900) as $item) {
    $i+=3;
  $numb=sprintf("%01.2f", $start + $increment * $i);


   $res_str.= "{$min}  {$hour} * * * sleep {$numb};    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/parsrun".PHP_EOL;

}
file_put_contents($file, $res_str,  LOCK_EX);

echo "ok".PHP_EOL;